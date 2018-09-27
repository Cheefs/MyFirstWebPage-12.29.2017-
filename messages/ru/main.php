<?php


return
    [
        'MyTables' =>'Таблици(справочники)',
        'Users' => 'Таблица пользоватей',
        'Task Types' => 'Таблица типов задач',
        'Tasks' => 'Таблица задач',
        'Task Statuses' => 'Таблица статусов',
        'Lnk Task Statuses' => 'Таблица связки статусов задач',
        'Task Statuses Orders' => 'Таблица статусов',
        'Task Users' => 'Таблица задач',
        'User Comments' => 'Таблиц коментариев',
        'Authorization' => 'Авторизация',
        'Enter Your Username' => 'Введите имя пользователя',
        'Enter Your Password' => 'Введите пароль',
        'Login' => 'Логин',
        'Incorrect username or password' => 'Неверное имя пользователя или пароль',
        'Enter Password' => 'Введите пароль',
        'Enter Username' => 'Введите имя пользователя',
        'Logout' => 'Выйти',
        'Photo' => 'Фото',




//        echo $form->field($model,'owner_lastname')->widget(
//            AutoComplete::className(), [
//            'clientOptions' => [
//                'appendTo' => '#modify-owner-form',
//                'source' => new JsExpression("function(request, response) {
//                        var url = \"\/".Yii::$app->controller->id."\/ajax-owner-search\/?field=lastname\";
//                        if ( $('#newownerform-owner_firstname').val().trim() != '' ) {
//                            url += '&firstname='+encodeURIComponent( $('#newownerform-owner_firstname').val().trim() );
//                        }
//                        if ( $('#newownerform-owner_secondname').val().trim() != '' ) {
//                            url += '&secondname='+encodeURIComponent( $('#newownerform-owner_secondname').val().trim() );
//                        }
//                        $.getJSON( url, { term: request.term }, response);
//                     }"),
//                'select' => new JsExpression("function( event, ui ) {
//                          $('#newownerform-owner_lastname').attr('data-id', ui.item.id);
//                    }"),
//                'autoFill' => true,
//                    'Focus' => true,
//                    'minLength' => '3',
//                ],
//                'options' => [
//    'class' => 'form-control',
//    'disabled' => $disabled
//]
//    ]);





//  /*
//     * Поиск Собственника по ФИО
//     * */
//    public function actionAjaxOwnerSearch($term, $field = null, $lastname = null, $firstname = null, $secondname = null)
//     {
//    if ( Yii::$app->request->isAjax && Yii::$app->request->isGet &&
//        $term !== null && $term != '' && mb_strlen( $term ) >= 2 &&
//        $field !== null && $field != "" && in_array( mb_strtolower( $field ), ['lastname', 'firstname', 'secondname'] )
//    ) {
//        $result = false;
//        $field = mb_strtolower( $field );
//        if ( $field == 'lastname' ) {
//            $response = SprOwners::find()->where( [ 'like', 'upper(lastname)', mb_convert_case( $term, MB_CASE_UPPER  )] );
//            if ( $firstname !== null ) {
//                $response->andWhere( [ 'like', 'upper(firstname)', mb_convert_case( $firstname,MB_CASE_UPPER ) ] );
//            }
//            if ( $secondname !== null ) {
//                $response->andWhere( [ 'like', 'upper(secondname)', mb_convert_case( $secondname, MB_CASE_UPPER ) ] );
//            }
//        } else if ( $field == 'firstname' ) {
//            $response = SprOwners::find()->where( [ 'like', 'upper(firstname)', mb_convert_case( $term, MB_CASE_UPPER  )] );
//                if ( $lastname !== null ) {
//                    $response->andWhere( [ 'like', 'upper(lastname)', mb_convert_case( $lastname, MB_CASE_UPPER ) ] );
//                }
//                if ( $secondname !== null ) {
//                    $response->andWhere( [ 'like', 'upper(secondname)', mb_convert_case( $secondname, MB_CASE_UPPER ) ] );
//                }
//            } else {
//            $response = SprOwners::find()->where( [ 'like', 'upper(secondname)', mb_convert_case( $term, MB_CASE_UPPER  )] );
//            if ( $lastname !== null ) {
//                $response->andWhere( [ 'like', 'upper(lastname)', mb_convert_case( $lastname, MB_CASE_UPPER ) ] );
//            }
//            if ( $firstname !== null ) {
//                $response->andWhere( [ 'like', 'upper(firstname)', mb_convert_case( $firstname, MB_CASE_UPPER ) ] );
//            }
//        }
//        $response = $response->all();
//        if ( $response != null ) {
//            $result = [];
//            foreach ($response as $row)
//            {
//                $result[]= [ 'id' => $row->id, 'name' => $row->$field, 'label' => $row->$field ];
//                }
//        }
//        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
//        return $result;
//    } else {
//        throw new HttpException(404 ,Yii::t('app', 'Page Not Found'));
//    }
//}
    ];