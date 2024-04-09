<template>
    <div class="row">

        <button @click.prevent="state.showCreateSectionModal = true" class="btn btn-primary er fs-6 px-8 py-4">افزودن سرفصل</button>

        <Modal v-model="state.showCreateSectionModal" title="افزودن سرفصل" @close="closeModals">
            <createSectionModal @submitted="storeSection" @close="closeModals"></createSectionModal>
        </Modal>
        <Modal v-model="state.showEditSectionModal" title="افزودن سرفصل" @close="closeModals">
            <editSectionModal @submitted="storeSection" :section="state.currentSection" @close="closeModals"></editSectionModal>
        </Modal>

        <Modal v-model="state.showCreateLessonModal" title="افزودن درس جدید" @close="closeModals">
            <CreateLessonModal @submitted="storeLesson" @close="closeModals"></CreateLessonModal>
        </Modal>
        <Modal v-model="state.showUpdateLessonModal" title="افزودن درس جدید" @close="closeModals">
            <EditLessonModal @submitted="updateLesson" @close="closeModals" :lesson="state.currentLesson"></EditLessonModal>
        </Modal>

        <div class="mt-10 builder row">
            <div v-for="section in state.sections" :key="section.id" class="col-12 mb-3">

                <div class="section">
                    <div class="section-header">
                        <h3 class="section-title">
                            {{ section.title }}
                        </h3>
                        <div class="section-actions">
                            <span class="edit-section" @click="showEditSectionModal">
                                ویرایش
                            </span>

                        </div>
                    </div>
                    <div class="lessons">
                        <draggable class="list-group" :list="section.lessons" group="group" @change="log" itemKey="id">
                            <template #item="{ element }">
                                <div class="list-group-item lesson-item">
                                    <div class="lesson-item--title">{{ element.title }}</div>
                                    <div class="lesson-item--actions">
                                        <span class="lesson-item--edit" @click="showEditLessonModal(section.id, element)">ویرایش</span>
                                    </div>
                                </div>
                            </template>
                        </draggable>
                    </div>
                    <div class="section-footer">
                        <button type="button" class="btn" @click="showCreateLessonModal(section.id)"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
import draggable from "vuedraggable";
import {reactive, onMounted, toRefs} from "vue";
import Modal from './UI/Modal';
import CreateSectionModal from "./modal/CreateSectionModal";
import EditSectionModal from "./modal/EditSectionModal";
import CreateLessonModal from "./modal/CreateLessonModal";
import EditLessonModal from "./modal/EditLessonModal.vue";

export default {
    components: {
        draggable,
        Modal,
        CreateSectionModal,
        EditSectionModal,
        CreateLessonModal,
        EditLessonModal
    },
    props: ['sections'],
    setup(props) {
        const {sections} = toRefs(props);
        const state = reactive({
            sections: [],
            showCreateSectionModal: false,
            showEditSectionModal: false,
            showCreateLessonModal: false,
            showUpdateLessonModal: false,
            currentSection: null,
            currentLesson: null
        })

        onMounted(() => {
            state.sections = sections.value;
        })

        const storeSection = (section) => {
            state.sections.push({
                id: new Date().getTime(),
                title: section.title,
                lessons: []
            })
            state.showCreateSectionModal = false;
        }


        const storeLesson = (lessonData) => {

            const index = state.sections.findIndex((item) => item.id === state.currentSection.id);

            state.sections[index].lessons.push({
                id: new Date().getTime(),
                title: lessonData.title,
                description: lessonData.description
            })

            closeModals();
        }

        const updateLesson = (lessonData) => {
            console.log('update', {lessonData})

            const section_index = state.sections.findIndex((item) => item.id === state.currentSection.id);



            const lesson_index = state.sections[section_index].lessons.findIndex((item) => item.id === state.currentLesson.id);


            state.sections[section_index].lessons[lesson_index] = lessonData;

            closeModals();
        }

        const showCreateLessonModal = (section_id) => {
            state.showCreateLessonModal = true;
            state.currentSection = section_id;
        }

        const closeModals = () => {
            console.group('emitted');
            state.showCreateLessonModal = false;
            state.showUpdateLessonModal = false;
            state.showCreateSectionModal = false;
            state.showEditSectionModal = false;
            state.currentSection = null;
            state.currentLesson = null;
        }

        const showEditLessonModal = (sectionId, lesson) => {
            state.currentSection = sectionId;
            state.currentLesson = lesson;
            state.showUpdateLessonModal = true;

        }

        const showEditSectionModal = (section) => {
            console.log('yesss', {section});
            state.currentSection = section;
            state.showEditSectionModal = true;
        }


        return {
            state,
            storeSection,
            showCreateLessonModal,
            closeModals,
            showEditLessonModal,
            updateLesson,
            storeLesson,
            showEditSectionModal
        }
    }
};
</script>

<style scoped>
.section {
    border: 1px solid silver;
    border-radius: 5px;
}
.section-header{
    background-color: silver;
    padding: 15px 10px;
    border-radius: 5px 0 0 5px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.edit-section {
    display: inline-block;
    cursor: poiner;
}
.lessons {
    padding: 10px;
    margin-right: 50px;
}
.lesson-item {
    display: flex;
    justify-content: space-between;
}
.lesson-item--actions {

}
.lesson-item--edit {
    cursor: pointer;
    display:inline-block;
}
</style>
