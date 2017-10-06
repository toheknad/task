<body>
<div class="container">
    <div class="menu">
        <ul>
            <li>Добавление</li>
            <b>|</b>
            <li>Удаление</li>
            <b>|</b>
            <li>Редактирование</li>
            <b>|</b>
            <li>Смешные картинки</li>

        </ul>
    </div>



    <div class="row">
        <div class="col col-md-12">
            <div class="tesk_style yellow">
                <div class="row">
                    <form method="post">
                    <div class="col col-md-12">
                        <label for="tesk_titel_add" style="padding: 20px; font-size: 30px">Заголовок:</label>
                        <input type="text" style="width: 80%; " name="tesk_titel_add">
                    </div>
                    <div class="col col-md-8">

                    </div>
                    <div class="col col-md-12 " style="height: 260px">

                            <b style="padding: 20px; font-size: 30px">Текст:</b>
                            <input type="text" style="height: 72%; width: 86% " name="tesk_text_add">

                    </div>

                    <div class="col col-md-12 text-center">
                        <select size="3" multiple name="tesk_status_add">
                            <option disabled>Выберите статус задачи</option>
                            <option value="3">Сделать срочно</option>
                            <option selected value="2" >Может подождать</option>
                            <option value="1">В планах</option>
                        </select>
                        <input type="submit" class="flat md blue">
                    </div>
                    </form>
                </div>

            </div>
        </div>


    </div>

</div>
</body>