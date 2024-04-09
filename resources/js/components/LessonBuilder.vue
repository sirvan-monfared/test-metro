<template>
    <div class="row">

        <Modal v-model="state.showCreateSectionModal" title="افزودن سرفصل" @close="closeModals">
            <createSectionModal @submitted="handleStoreSection" @close="closeModals"></createSectionModal>
        </Modal>
        <Modal v-model="state.showEditSectionModal" title="ویرایش سرفصل" @close="closeModals">
            <editSectionModal @submitted="handleUpdateSection" :id="state.currentSectionId" @close="closeModals"></editSectionModal>
        </Modal>

        <Modal v-model="state.showCreateLessonModal" title="افزودن درس جدید" @close="closeModals">
            <CreateLessonModal @submitted="handleStoreLesson" @close="closeModals"></CreateLessonModal>
        </Modal>

        <Modal v-model="state.showUpdateLessonModal" title="ویرایش درس" @close="closeModals">
            <EditLessonModal @submitted="handleUpdateLesson" @close="closeModals" :section-id="state.currentSectionId" :lesson-id="state.currentLessonId"></EditLessonModal>
        </Modal>

        <div class="mt-10 builder row">
            <div v-for="section in sections" :key="section.id" class="col-12 mb-3">

                <div class="section">
                    <div class="section-header">
                        <h3 class="section-title">
                            {{ section.title }}
                        </h3>
                        <div class="section-actions ">

                            <span class="remove-section" @click="confirmDelete(section.id)">
                                <i class="fa fa-trash"></i>
                                <span>حذف</span>
                            </span>

                            <span class="edit-section" @click="showEditSectionModal(section.id)">
                                ویرایش
                            </span>


                        </div>
                    </div>
                    <div class="lessons">
                        <draggable class="list-group" :list="section.lessons" group="group" itemKey="id">

                            <template #item="{ element }">
                                <div class="list-group-item lesson-item">
                                    <div class="lesson-item--title">{{ element.title }}</div>
                                    <div class="lesson-item--actions">
                                        <span class="lesson-item--edit" @click="showEditLessonModal(section.id, element.id)">ویرایش</span>
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

        <i class="fa fa-plus text-danger add-section-button" @click="state.showCreateSectionModal = true"></i>

        <input type="hidden" name="lessons" v-model="state.sorted">
    </div>

</template>
<script>
import draggable from "vuedraggable";
import {reactive, onMounted, toRefs, watch} from "vue";
import Modal from './UI/Modal';
import CreateSectionModal from "./modal/CreateSectionModal";
import EditSectionModal from "./modal/EditSectionModal";
import CreateLessonModal from "./modal/CreateLessonModal";
import EditLessonModal from "./modal/EditLessonModal.vue";
import useBuilder from '../composables/useBuilder';


export default {
    components: {
        draggable,
        Modal,
        CreateSectionModal,
        EditSectionModal,
        CreateLessonModal,
        EditLessonModal
    },
    props: ['id'],
    setup(props) {
        const {id} = toRefs(props);

        const state = reactive({
            showCreateSectionModal: false,
            showEditSectionModal: false,
            showCreateLessonModal: false,
            showUpdateLessonModal: false,
            currentSectionId: null,
            currentLessonId: null,
            sorted: null
        })

        const {sections, fetchSections, storeSection, updateSection, deleteSection, storeLesson, updateLesson, sortItems} = useBuilder();

        onMounted(() => {
            fetchSections(id.value);
        })
        watch(() => sections.value, () => {
            logChanges();
        }, {deep: true})


        const handleUpdateSection = (section) => {
            updateSection(section, id.value);
            state.showEditSectionModal = false;
        }

        const handleStoreSection = (section) => {
        	   storeSection(section, id.value);
               state.showCreateSectionModal = false;
        }


        const handleStoreLesson = (lesson) => {
            console.log('handle', lesson);
            storeLesson(id.value, state.currentSectionId, lesson);
            closeModals();
        }

        const handleUpdateLesson = (lesson_data) => {
           updateLesson(id.value, state.currentSectionId, state.currentLessonId, lesson_data)

            closeModals();
        }

        const showCreateLessonModal = (section_id) => {
            state.currentSectionId = section_id;
            state.showCreateLessonModal = true;
        }

        const closeModals = () => {
            console.group('emitted');
            state.showCreateLessonModal = false;
            state.showUpdateLessonModal = false;
            state.showCreateSectionModal = false;
            state.showEditSectionModal = false;
            state.currentSectionId = null;
            state.currentLessonId = null;
        }

        const showEditLessonModal = (sectionId, lesson) => {
            state.currentSectionId = sectionId;
            state.currentLessonId = lesson;
            state.showUpdateLessonModal = true;

        }

        const showEditSectionModal = (section_id) => {
            state.currentSectionId = section_id;
            state.showEditSectionModal = true;
        }

        const confirmDelete = (section_id) => {
            const confirm = window.confirm(`do you really want to delete this section?`);

            if (confirm) {
                deleteSection(section_id)
            }
        }

        const logChanges = () => {
            state.sorted = JSON.stringify(sortItems());
        }

        return {
            state,
            sections,
            handleStoreSection,
            handleUpdateSection,
            showCreateLessonModal,
            closeModals,
            showEditLessonModal,
            handleUpdateLesson,
            handleStoreLesson,
            showEditSectionModal,
            confirmDelete
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
    cursor: pointer;
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
.add-section-button{
    text-align: center;
    font-size: 50px;
    margin-top: 20px;
    cursor: pointer;
}
.section-actions {
    display: flex;
    gap: 12px;
    align-items: center
}
.remove-section {
    color: darkred;
    display: flex;
    gap: 4px;
    align-items: center;
    cursor: pointer;
}
.remove-section i {
    color: darkred;
}

</style>
