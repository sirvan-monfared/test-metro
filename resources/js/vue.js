import {createApp} from "vue";
import LessonBuilder from "./components/LessonBuilder";
import LessonFiles from './components/LessonFiles';
import SectionPicker from './components/SectionPicker';
import DiscountPicker from "./components/DiscountPicker";
import UserSelect from "./components/admin/UserSelect";
import DeleteConfirm from "./components/UI/DeleteConfirm";
import CommentStatus from "./components/admin/CommentStatus";
import Vue3PersianDatetimePicker from 'vue3-persian-datetime-picker'
import TagsInput from './components/admin/TagsInput';
import StarRating from 'vue-star-rating';
import Chart from './components/admin/Chart';
import FaqBuilder from './components/admin/FaqBuilder';
import PersianDatePicker from './components/admin/PersianDatePicker';

const app = createApp({});

app.component('lesson-builder', LessonBuilder);
app.component('lesson-files', LessonFiles);
app.component('section-picker', SectionPicker);
app.component('discount-picker', DiscountPicker);
app.component('user-select', UserSelect);
app.component('delete-confirm', DeleteConfirm);
app.component('comment-status', CommentStatus);
app.component('DatePicker', Vue3PersianDatetimePicker);
app.component('tags-input', TagsInput);
app.component('star-rating', StarRating);
app.component('chart', Chart);
app.component('faq-builder', FaqBuilder);
app.component('persian-date-picker', PersianDatePicker);

app.mount('#app');


