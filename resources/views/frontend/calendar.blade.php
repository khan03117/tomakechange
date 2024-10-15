<style>
    .calendar {
        height: max-content;
        width: max-content;
        background-color: var(--bg-main);
        border-radius: 30px;
        padding: 20px;
        position: relative;
        overflow: hidden;
    }

    .light .calendar {
        box-shadow: var(--shadow);
    }

    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 25px;
        font-weight: 600;
        color: var(--color-txt);
        padding: 10px;
    }

    .calendar-body {
        padding: 10px;
    }

    .calendar-week-day {
        height: 50px;
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        font-weight: 600;
    }

    .calendar-week-day div {
        display: grid;
        place-items: center;
        color: var(--bg-second);
        display: grid;
        place-items: center;
        color: var(--bg-second);
        font-size: 11px;
        color: #077773;
        text-transform: uppercase;
        font-weight: 700;
    }

    .calendar-days {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 2px;
        color: var(--color-txt);
    }

    .calendar-days div {
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 9px;
        position: relative;
        cursor: pointer;
        animation: to-top 1s forwards;
        padding: 6px;
    }

    .calendar-days div span {
        position: absolute;
    }

    .calendar-days div:hover span {
        transition: width 0.2s ease-in-out, height 0.2s ease-in-out;
    }

    #year {
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase
    }

    .calendar-days div span:nth-child(1),
    .calendar-days div span:nth-child(3) {
        width: 2px;
        height: 0;
        background-color: var(--color-txt);
    }

    .calendar-days div:hover span:nth-child(1),
    .calendar-days div:hover span:nth-child(3) {
        height: 100%;
    }

    .calendar-days div span:nth-child(1) {
        bottom: 0;
        left: 0;
    }

    .calendar-days div span:nth-child(3) {
        top: 0;
        right: 0;
    }

    .calendar-days div span:nth-child(2),
    .calendar-days div span:nth-child(4) {
        width: 0;
        height: 2px;
        background-color: var(--color-txt);
    }

    .calendar-days div:hover span:nth-child(2),
    .calendar-days div:hover span:nth-child(4) {
        width: 100%;
    }

    .calendar-days div span:nth-child(2) {
        top: 0;
        left: 0;
    }

    .calendar-days div span:nth-child(4) {
        bottom: 0;
        right: 0;
    }

    .calendar-days div:hover span:nth-child(2) {
        transition-delay: 0.2s;
    }

    .calendar-days div:hover span:nth-child(3) {
        transition-delay: 0.4s;
    }

    .calendar-days div:hover span:nth-child(4) {
        transition-delay: 0.6s;
    }

    .calendar-days div.curr-date,
    .calendar-days div.curr-date:hover {
        background-color: var(--blue);
        color: var(--white);
        border-radius: 50%;
    }

    .calendar-days div.curr-date span {
        display: none;
    }

    .month-picker {
        padding: 0;
        border-radius: 0px;
        cursor: pointer;
        font-size: 14px;
        color: #f67c33;
        font-weight: 700;
    }

    .month-picker:hover {
        background-color: var(--color-hover);
    }

    .year-picker {
        display: flex;
        align-items: center;
    }

    .disabled {
        pointer-events: none;
        color: #cacaca;

    }

    .year-change {

        cursor: pointer;
    }

    .year-change:hover {
        background-color: var(--color-hover);
    }

    .calendar-footer {
        padding: 10px;
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    .toggle {
        display: flex;
    }

    .toggle span {
        margin-right: 10px;
        color: var(--color-txt);
    }

    .month-list {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background-color: var(--bg-main);
        padding: 20px;
        grid-template-columns: repeat(3, auto);
        gap: 5px;
        display: grid;
        transform: scale(1.5);
        visibility: hidden;
        pointer-events: none;
    }

    .month-list.show {
        transform: scale(1);
        visibility: visible;
        pointer-events: visible;
        transition: all 0.2s ease-in-out;
        background: #fff;

    }

    .month-list>div {
        display: grid;
        place-items: center;
    }

    .month-list>div>div {
        width: 100%;
        padding: 5px 5px;
        border-radius: 10px;
        text-align: center;
        cursor: pointer;
        color: var(--color-txt);
    }

    .month-list>div>div:hover {
        background-color: var(--color-hover);
    }

    .calendar-day-hover {
        position: relative;
        transition: all 0.4s;
        border-radius: 50%;
        margin: 7px;
    }

    .calendar-day-hover::before {
        content: "";
        position: absolute;
        top: 50%;
        /* left: 0; */
        left: 50%;
        transform: translate(-50%, -50%);
        width: 0;
        height: 0;
        transition: all 0.5s;
    }
</style>
<div class="calendar  border w-100 p-1 rounded box-shadow-1">
    <div class="calendar-header">
        <div class="year-picker d-flex gap-2 text-primary align-items-center">
            <span class="year-change visually-hidden" id="prev-year">
                &#10094;
            </span>
            <span id="year">2022</span>
            <span class="year-change visually-hidden" id="next-year">
                &#10095;
            </span>
        </div>
        <div class="d-flex align-items-center gap-1">
            <span class="year-change text-primary" id="prev-month">
                &#10094;
            </span>
            <span class="month-picker text-primary" id="month-picker">April</span>
            <span class="year-change text-primary" id="next-month">
                &#10095;
            </span>
        </div>


    </div>
    <div class="calendar-body">
        <div class="calendar-week-day">
            <div>Sun</div>
            <div>Mon</div>
            <div>Tue</div>
            <div>Wed</div>
            <div>Thu</div>
            <div>Fri</div>
            <div>Sat</div>
        </div>
        <div class="calendar-days"></div>
    </div>

    <div class="month-list"></div>
</div>
