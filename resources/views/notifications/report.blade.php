گزارش عملکرد {{$report->type}}   سایت لاراپلاس
منتشرشده در: {{ $report->generated_on }}
از: {{ $report->from_jalali }}
تا: {{ $report->to_jalali }}
-----------------------------------------------
کاربر جدید: {{ $report->data->users_registered }}
درآمد: {{ $report->data->total_income }}
ثبت نام ها: {{ $report->data->total_enrollments }}
-----------------------------------------------
تفکیک ثبت نام دوره ها:
@foreach($report->data->course_enrollments as $course_name => $enrolls)
-{{ $course_name }}: {{ $enrolls }}
@endforeach
-----------------------------------------------
کامنت ها: {{ $report->data->total_comments }}
تمرین ها: {{ $report->data->total_exercises }}
سفارش ناموفق: {{ $report->data->failed_orders }}
امتیاز کاربران: {{ $report->data->total_user_points }}


