<template>
    <section class="flex items-center justify-center wheel_wrapper min-h-full">
        <div class="wheel_container max-w-md aspect-square" @click="rotate">
            <div class="spinBtn text-sm">بچرخون</div>
            <div class="wheel" ref="wheel" v-if="prizes">
                <div class="number" v-for="prize in prizes" :key="prize.id"
                     :style="{'--i': prize.id, '--clr': prize.color}"><span class="text-md md:text-2xl">{{ prize.text }}</span></div>
            </div>
        </div>
    </section>
</template>
<script setup>
import {onMounted, ref} from "vue";
import axios from "axios";
import {route} from "../../routes";

const wheel = ref(null);
const prizes = ref(null);
const prize = ref(null);
const won = ref(false);
const delivery = ref(false);

onMounted(() => {
    fetchPrizes();
})

const rotate = () => {
    getRotationDegree().then((finalDegree) => {

        wheel.value.style.transform = `rotate(-${finalDegree}deg)`;

        let transitionEndEventName = getTransitionEndEventName();
        wheel.value.addEventListener(transitionEndEventName, onRotationEnd);
    });
}

const fetchPrizes = async () => {
    const {data: result} = await axios.post(route('api.wheel.prizes'));
    prizes.value = result.prizes;

    if (result.already_attended) {
        successModal(result.prize.title, result.prize.description);
    }
}

const fetchPrize = async () => {
    const {data: result} = await axios.get(route('api.wheel.rotate'));

    prize.value = result.prize;
    won.value = result.won;
    delivery.value = result.delivery;
}

const getRotationDegree = async () => {
    const sections = prizes.value;
    const sectionAngle = 360 / sections.length;

    await fetchPrize();

    const prizeIndex = sections.findIndex((item) => item.id === prize.value.id);

    const baseAngle = prizeIndex * sectionAngle;
    const rotationsDegree = randomBetween(3, 10) * 360;
    const boundary = randomBetween(-18, 18);

    return baseAngle + rotationsDegree + boundary;
}

const onRotationEnd = () => {
    if (won.value) {
        successModal();
        victoryRain();
    } else {
        failedModal();
    }
}

function randomBetween(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min)
}

function getTransitionEndEventName() {
    let transitions = {
        "transition": "transitionend",
        "OTransition": "oTransitionEnd",
        "MozTransition": "transitionend",
        "WebkitTransition": "webkitTransitionEnd"
    }
    let bodyStyle = document.body.style;
    for (let transition in transitions) {
        if (bodyStyle[transition] !== undefined) {
            return transitions[transition];
        }
    }
}

function successModal(title, text) {
    Swal.fire({
        title: title || prize.value.prize,
        text: text || delivery.value,
        icon: 'success',
        confirmButtonText: 'باشه!'
    })
}

function failedModal() {
    Swal.fire({
        title: 'پوچ',
        text: 'متاسفانه یه خورده بدشانس بودی',
        icon: 'error',
        confirmButtonText: 'باشه!'
    })
}

function victoryRain() {

    const duration = 3 * 1000,
        animationEnd = Date.now() + duration,
        defaults = {startVelocity: 40, spread: 360, ticks: 60, zIndex: 0};

    const interval = setInterval(function () {
        const timeLeft = animationEnd - Date.now();

        if (timeLeft <= 0) {
            return clearInterval(interval);
        }

        const particleCount = 50 * (timeLeft / duration);

        confetti(
            Object.assign({}, defaults, {
                particleCount,
                origin: {x: randomBetween(0.1, 0.3), y: Math.random() - 0.2},
            })
        );
        confetti(
            Object.assign({}, defaults, {
                particleCount,
                origin: {x: randomBetween(0.7, 0.9), y: Math.random() - 0.2},
            })
        );
    }, 250);
}
</script>

<style scoped>
@media (min-width: 768px) {
	.wheel_wrapper {
        min-height: 550px;
    }
}

.wheel_container {
    position: relative;
    width: 90%;
    display: flex;
    justify-content: center;
    align-items: center;
    direction: ltr;
}

.wheel_container .spinBtn {
    position: relative;
    width: 60px;
    height: 60px;
    background: #fff;
    border-radius: 50%;
    z-index: 10;
    display: flex;
    justify-content: center;
    align-items: center;
    font-weight: 600;
    color: #333;
    border: 4px solid rgba(0, 0, 0, 0.75);
    user-select: none;
    cursor: pointer;
}

.wheel_container .spinBtn::before {
    position: absolute;
    content: "";
    top: -28px;
    width: 20px;
    height: 30px;
    background: #fff;
    clip-path: polygon(50% 0%, 15% 100%, 85% 100%);
}

.wheel_container .wheel {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #333;
    border-radius: 50%;
    overflow: hidden;
    box-shadow: 0 0 0 5px #333, 0 0 0 15px #fff, 0 0 0 18px #111;
    transition: transform 5s cubic-bezier(0.17, 0.82, 0.31, 1); /* Custom cubic bezier */
}

.wheel_container .wheel .number {
    position: absolute;
    width: 50%;
    height: 50%;
    background: var(--clr);
    transform-origin: bottom right;
    transform: rotate(calc(45deg * var(--i)));
    clip-path: polygon(0 0, 56% 0, 100% 100%, 0 56%);
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    user-select: none;
}

.wheel_container .wheel .number span {
    position: relative;
    transform: rotate(45deg);
    font-weight: 700;
    color: #fff;
    text-shadow: 3px 5px 2px rgba(0, 0, 0, 0.15);
    direction: rtl;
}
</style>
