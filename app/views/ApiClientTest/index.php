<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>API Client - Marenco</title>
    </head>
    <body style="background-color:#aaa;color:#fff;">
        <select id="method">
            <option value="GET">GET</option>
            <option value="POST">POST</option>
            <option value="DELETE">DELETE</option>
        </select>
        https://<?= $_SERVER['HTTP_HOST'] ?>/<input type="text" size="30" name="url" id="url" value="" />
        <select id="usemethod">
            <option rel="" rel2='' value=""> -- select method --</option>

            <optgroup label="DOCUMENTS">
                <!-- ---------------------------- LIST------------------------------>
                <option rel="POST" rel2='{"with_group":0,"with_attributes":0,"documents_groups__id":6}' value="documents/list">POST documents/list</option>-->
                <option rel="POST" rel2='{"with_group":0,"with_attributes":1}' value="documents/list">POST documents/list (attributes)</option>-->
                <option rel="POST" rel2='{"with_group":1,"with_attributes":0}' value="documents/list">POST documents/list (groups)</option>-->

                <!-- ---------------------------- ADD------------------------------>
                <option rel="POST" rel2='{"documents_groups__id":"1","name":"Lifereschein & CofC","description":"DIN EN ISO/IEC 17025","type":"CofC","order_number":"0","user__id":1}' value="documents/add">POST documents/add</option>-->
               

                <!-- ---------------------------- UPDATE------------------------------>
                <option rel="POST" rel2='{"id":"1","name":"Example","description":"XYZ 123321","type":"CofC","order_number":"0","user__id":1}' value="documents/update">POST documents/update</option>-->

                <!-- ----------------------------DELETE------------------------------>
                <option rel="POST" rel2='{"id":,"documents_groups__id":}' value="documents/delete">POST documents/delete</option>-->

            </optgroup>

            <optgroup label="USERS">
                <option rel="POST" rel2='{"username":"user0","password":"surname"}' value="users/login">POST login</option>
            </optgroup>
        </select>
        <input type="checkbox" id="global" name="global" />
        <br />
        <textarea id="jsondata" style="width:900px;height:200px;"></textarea>
        <textarea id="hashdata" style="width:900px;height:20px;"></textarea>

        <input type="button" value="run" id="runbutton" />
        <br /><br />
        <?= $_SERVER['SERVER_NAME'] ?>
        <br />
        <div id="log" style="line-height:20px;border:1px solid #ccc;padding:10px;margin:10px;font-size:12px;font-family:Arial;background-color:#fff;color:#000;">
        </div>


<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>-->
        <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {

                $('#runbutton').on("click", function () {
                    runUrl(
                            $('#url').val(),
                            $('#method').val(),
                            $('#jsondata').val(),
                            $('#global').attr('checked')
                            );
                });
                //
                $('#usemethod').on("change", function () {
                    $('#url').attr('value', $(this).val());
                    $('#method').val($("#usemethod option:selected").attr('rel'));
                    $('#jsondata').val($("#usemethod option:selected").attr('rel2'));
                });

                //
                function runUrl(url, method, jsondata, global) {
                    try {
                        var jsonObject = JSON.parse(jsondata);
                        // append hash to json
                        if (typeof jsonObject.hash === 'undefined' || jsonObject.hash.length === 0) {
                            var hashJSON = "{" + $("#hashdata").val() + "}";
                            var hashObj = JSON.parse(hashJSON);
                            if (typeof hashObj.hash !== 'undefined') {
                                console.log(hashObj);
                                jsonObject.hash = hashObj.hash;
                                jsondata = JSON.stringify(jsonObject);
                            }
                        }
                    } catch (ex) {
                        console.log('empty input');
                    }
                    $.ajax({
                        url: '/developers/api/send',
                        type: 'POST',
                        processData: "false",
                        data: {
                            url: url,
                            method: method,
                            json: jsondata,
                            global: global
                        },
                        beforeSend: function () {
                            $('#log').html('');
                        },
                        success: function (data) {
                            $('#log').html(data);
                            if ($('#url').val() == '/users/login') {
                                var resObject = JSON.parse(data);
                                //alert( resObject.message.user.hash );
                                $("#hashdata").val('"hash":"' + resObject.hash + '"');
                            }
                        },
                        error: function (data) {
                            $('#log').html(data);
                        }
                    });
                }

            });
        </script>
    </body>
</html>
