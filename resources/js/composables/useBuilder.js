import {reactive, computed} from 'vue';
import axios from 'axios';

const builderState = reactive({
    sections: [],
    section: null,
    lesson: null,
    isLoading: false
})

export default function useBuilder() {

    const storeSection = async (section, course_id) => {
          const {data: result} = await axios.post(`/lara-admin/api/${course_id}/sections/store`, {
              section: section
          });

          if (! result.section) return;

          builderState.sections.push(result.section);
    }

    const updateSection = async (section, course_id) => {
        const {data: result} = await axios.patch(`/lara-admin/api/${course_id}/sections/${section.id}`, {
            section: section
        });

        if (! result.section) return;

        const index = builderState.sections.findIndex((item) => item.id === section.id);
        builderState.sections[index].name = section.name;
        builderState.sections[index].description = section.description;
    }

    const deleteSection = async (section_id) => {
        const {data: result} = await axios.delete(`/lara-admin/api/sections/${section_id}`, {
            section: section_id
        });

        if (! result.message) return;

        const index = builderState.sections.findIndex((item) => item.id === section_id);

        builderState.sections.splice(index, 1);
    }

    const findSection = (section_id) => {
        if (! sections.value || ! section_id) return;

        builderState.section = sections.value.find((item) => item.id === section_id);
    }

    const fetchSections = async (course_id) => {
        if (builderState.sections.length) return false;

        builderState.isLoading = true;

        const {data: sections} = await axios.get(`/lara-admin/api/${course_id}/sections`);
        builderState.sections = sections;
    }

    const findLesson = (section_id, lesson_id) => {
        if (! section_id || ! lesson_id) return;

        const section = builderState.sections.find((item) => item.id === section_id);

        builderState.lesson = section.lessons.find((item) => item.id === lesson_id);
    }

    const storeLesson = async (course_id, section_id, lesson) => {
        const {data: result} = await axios.post(`/lara-admin/api/${course_id}/sections/${section_id}/lesson`, {
            lesson: lesson
        });

        if (! result.lesson) return;

        const section_index = builderState.sections.findIndex((item) => item.id === section_id);

        builderState.sections[section_index].lessons.push(result.lesson);
    }

    const updateLesson = async (course_id, section_id, lesson_id, lesson) => {
        const {data: result} = await axios.patch(`/lara-admin/api/${course_id}/sections/${section_id}/lesson/${lesson_id}`, {
            lesson: lesson
        });

        if (! result.lesson) return;

        const section_index = builderState.sections.findIndex((item) => item.id === section_id);
        const lesson_index = builderState.sections[section_index].lessons.findIndex((item) => item.id === lesson_id);

        builderState.sections[section_index].lessons[lesson_index] = result.lesson;
    }

    const sortItems = () => {
        let sorted = [];
        builderState.sections.map((item, index) => {
            sorted.push({
                section_id: item.id,
                lessons: item.lessons.map((lesson, index) => {
                    return {
                        lesson_id: lesson.id,
                        order: index + 1
                    }
                })
            });
        })
        return sorted;
    }

    const sections = computed(() => {
        return builderState.sections;
    })

    const section = computed(() => {
        return builderState.section;
    })

    const lesson = computed(() => {
        return builderState.lesson;
    })
    const isLoading = computed(() => {
        return builderState.isLoading;
    })
    return {
        findSection,
        storeSection,
        updateSection,
        deleteSection,
        fetchSections,
        storeLesson,
        updateLesson,
        findLesson,
        sortItems,
        sections,
        section,
        lesson
    }
}
