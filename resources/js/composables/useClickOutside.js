import {onMounted, onBeforeUnmount} from "vue";

export default function useClickOutside(target_ref, callback) {
    if (! target_ref) return null;
    let listener = (e) => {
        if (e.target == target_ref.value || e.composedPath().includes(target_ref.value)) {
            return;
        }
        if (typeof callback === 'function') {
            callback();
        }
    }

    onMounted(() => {
        window.addEventListener('click', listener);
    })
    onBeforeUnmount(() => {
        window.removeEventListener('click', listener)
    })

    return {
        listener
    }
}
