<div class="date-filters">
    <div class="d-flex gap-2 align-items-center mb-1">
       <span>از: </span>
       <persian-date-picker simple name="from_date" format="jYYYY/jMM/jDD" initial="{{ request()->from_date }}"/>
    </div>

    <div class="d-flex gap-2 align-items-center ">
        <span>تا: </span>
        <persian-date-picker simple name="to_date" format="jYYYY/jMM/jDD" initial="{{ request()->to_date }}"/>
    </div>
</div>
