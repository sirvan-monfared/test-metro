<template>
    <div class="mt-10 fv-row">

        <label class="required form-label" for="course_id"> نام دوره</label>
        <select name="course_id" id="course_id"  @change="courseSelected" class="form-select" data-hide-search="true" data-placeholder="نام دوره را انتخاب کنید">
            <option value="any">انتخاب کنید</option>
            <option v-for="course in state.courses" :value="course.id" :selected="course.id === courseId">{{ course.title }}</option>
        </select>
    </div>

    <div class="mt-10 fv-row">
        <label class="required form-label" for="section_id"> نام بخش</label>
        <select name="section_id" id="section_id" class="form-select" data-hide-search="true" data-placeholder="بخش موردنظر را انتخاب کنید">
            <option v-for="section in state.sections" :value="section.id" :selected="section.id === sectionId">{{ section.title }}</option>
        </select>
    </div>
</template>
<script>
import {reactive, onMounted, toRefs} from 'vue';
import axios from 'axios';

export default {
    props: ['courseId', 'sectionId'],
    setup(props) {
        const {sectionId, courseId} = toRefs(props);

        const state = reactive({
            courses: [],
            sections: []
        })

        onMounted(() => {
            fetchCourses();
            if (courseId.value) {
                fetchLessonsFor(courseId.value);
            }
        })

        const fetchCourses = async () => {
            const {data: result} = await axios.get('/lara-admin/api/courses');

            if (! result) return;

            state.courses = result.courses;
        }

        const courseSelected = async (event) => {
            if (event.target.value === 'any') {
                state.sections = [];
                return;
            }

            await fetchLessonsFor(event.target.value);
        }

        const fetchLessonsFor = async (course_id) => {
            const {data: result} = await axios.get(`/lara-admin/api/${course_id}/sections`);

            if (! result) return;

            state.sections = result;
        }

        return {
            state,
            courseSelected
        }
    }
}
</script>
