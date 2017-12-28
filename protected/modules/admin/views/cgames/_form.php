<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'news-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation'=>false, 'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )); ?>
    <?php echo $form->errorSummary($model); ?>
    <table class="table tableqr">
        <tbody>
        <tr>
            <td align="right"><b>游戏名</b></td>
            <td>
                <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
            </td>
        </tr>
        <tr>
            <td align="right"><b>游戏入口地址</b></td>
            <td>
                <?php echo $form->textField($model,'enter',array('size'=>60,'maxlength'=>255)); ?>
            </td>
        </tr>
        <tr>
            <td align="right"><b>支付回调地址</b></td>
            <td>
                <?php echo $form->textField($model,'notify_url',array('size'=>60,'maxlength'=>255)); ?>
            </td>
        </tr>
        <tr>
            <td align="right"><b>审核状态</b></td>
            <td>
                <?php echo $form->radioButtonList($model, 'status', array('0'=>'待审核','1'=>'已审核','2'=>'审核不通过','3'=>'禁用')); ?>
            </td>
        </tr>
        <?php if ($model->from == 1): ?>
        <tr>
            <td align="right"><b>游戏折扣(7折写0.7)</b></td>
            <td>
                <?php echo $form->textField($model,'discount',array('size'=>60,'maxlength'=>10)); ?>
            </td>
        </tr>
        <?php endif; ?>
        <tr>
            <td align="right"><b>分类</b></td>
            <td>
                <?php
                if ($model->from == 1) {
                    $wangyoufenlei = Yii::app()->params['wangyoufenlei'];
                } else {
                    $wangyoufenlei = Yii::app()->params['danjifenlei'];
                }
                $optionsArr=array();
                foreach ($wangyoufenlei as $value){
                    $optionsArr[$value['name']] = $value['name'];
                }
                ?>
                <?php echo $form->dropDownList($model, 'type', $optionsArr); ?>
            </td>
        </tr>
        <tr>
            <td align="right"><b>游戏描述</b></td>
            <td>
                <?php echo $form->textArea($model,'desc',array('rows'=>6, 'cols'=>50)); ?>
            </td>
        </tr>
        <tr>
            <td align="right"><b>游戏短描述</b></td>
            <td>
                <?php echo $form->textField($model,'short_desc',array('size'=>60,'maxlength'=>255)); ?>
            </td>
        </tr>
        <style>
            ul li{
                position: relative;
                /*overflow: hidden;*/
                zoom: 1;
                width: 160px;
                float: left;
                margin-right: 10px;
                /*margin-left: 10px;*/
            }
            ul li img{
                max-width: 160px;
                max-height: 240px;
                float: left;
                border: 1px solid #666;
            }
            #img_icon{
                width: 100px;
                height: 100px;
                border: 1px solid #666;
            }
            .cole{
                height: 16px;
                position: absolute;
                top: -9px;
                right: -8px;
                width: 16px;
                background: url("/upload/small.png") no-repeat scroll -20px -40px;
                cursor: pointer;
            }
        </style>
        <tr>
            <td align="right"><b>icon(100x100)</b></td>
            <td>
                <?php if (empty($model->icon)): ?>
                    <img id="img_icon" onclick="clickInput(this, '_icon')" src="/upload/default_icon.png" alt="">
                    <input id="hiddenImg_icon" type="hidden" name="Games[icon]" value="" />
                <?php else: ?>
                    <img id="img_icon" onclick="clickInput(this, '_icon')" src="<?=$model->icon ?>" alt="">
                    <input id="hiddenImg_icon" type="hidden" name="Games[icon]" value="<?=$model->icon ?>" />
                <?php endif; ?>
                <input id="input_icon" style="display: none" type="file" name="Games['img_icon']" class="ata_pt" onchange="previewImage('icon', '_icon')"/>
            </td>
        </tr>
        <tr>
            <td align="right"><b>截图(400x600)</b></td>
            <td>
                <ul>
                    <?php if (empty($model->game_picture)): ?>
                        <li>
                            <img id="img1" onclick="clickInput(this, 1)" src="/upload/default_img.png" alt="">
                            <div class="cole" onclick="delImg(this, 1)"></div>
                        </li>
                        <li>
                            <img id="img2" onclick="clickInput(this, 2)" src="/upload/default_img.png" alt="">
                            <div class="cole" onclick="delImg(this, 2)"></div>
                        </li>
                        <li>
                            <img id="img3" onclick="clickInput(this, 3)" src="/upload/default_img.png" alt="">
                            <div class="cole" onclick="delImg(this, 3)"></div>
                        </li>
                        <li>
                            <img id="img4" onclick="clickInput(this, 4)" src="/upload/default_img.png" alt="">
                            <div class="cole" onclick="delImg(this, 4)"></div>
                        </li>
                        <li>
                            <img id="img5" onclick="clickInput(this, 5)" src="/upload/default_img.png" alt="">
                            <div class="cole" onclick="delImg(this, 5)"></div>
                        </li>

                        <input id="hiddenImg1" type="hidden" name="Games[game_picture][]" value="" />
                        <input id="hiddenImg2" type="hidden" name="Games[game_picture][]" value="" />
                        <input id="hiddenImg3" type="hidden" name="Games[game_picture][]" value="" />
                        <input id="hiddenImg4" type="hidden" name="Games[game_picture][]" value="" />
                        <input id="hiddenImg5" type="hidden" name="Games[game_picture][]" value="" />
                    <?php else:
                        $imgs = json_decode($model->game_picture);
                        foreach ($imgs as $key=>$img) {
                            $key++;
                            echo '<li>
                                      <img id="img'.$key.'" onclick="clickInput(this, '.$key.')" src="'.$img.'" alt="">
                                      <div class="cole" onclick="delImg(this, '.$key.')"></div>
                                  </li>
                                  <input id="hiddenImg'.$key.'" type="hidden" name="Games[game_picture][]" value="'.$img.'" />
                                ';
                        }
                        for ($i = count($imgs)+1; $i <= 5; $i++) {
                            echo '<li>
                                     <img id="img'.$i.'" onclick="clickInput(this, '.$i.')" src="/upload/default_img.png" alt="">
                                     <div class="cole" onclick="delImg(this, '.$i.')"></div>
                                  </li>
                                  <input id="hiddenImg'.$i.'" type="hidden" name="Games[game_picture][]" value="" />
                            ';
                        }
                        ?>
                    <?php endif; ?>
                </ul>

                <input id="input1" style="display: none" type="file" name="Games['img1']" class="ata_pt" onchange="previewImage('game_picture', 1)"/>
                <input id="input2" style="display: none" type="file" name="Games['img2']" class="ata_pt" onchange="previewImage('game_picture', 2)"/>
                <input id="input3" style="display: none" type="file" name="Games['img3']" class="ata_pt" onchange="previewImage('game_picture', 3)"/>
                <input id="input4" style="display: none" type="file" name="Games['img4']" class="ata_pt" onchange="previewImage('game_picture', 4)"/>
                <input id="input5" style="display: none" type="file" name="Games['img5']" class="ata_pt" onchange="previewImage('game_picture', 5)"/>
            </td>
        </tr>
        </tbody></table>

    <div class="row buttons" style='margin: 30px;'>
        <?php echo CHtml::submitButton('保存'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->
<script type="text/javascript">

    $('li img').each(function (i) {
        if ($(this).attr('src') == '/upload/default_img.png') {
            $(this).next('.cole').css('display', 'none');
        }
    });

    function clickInput(obj, num) {
        $('#input' + num).click();
    }

    function delImg(obj, num) {
        $('#img'+num).attr('src', '/upload/default_img.png');
        $('#hiddenImg'+num).val('');
        $('#img'+num).next('.cole').css('display', 'none');
    }

    function previewImage(obj, count) {
        var oldImg = $("#img"+count).attr('src');

        $.ajaxFileUpload({
            url:'/backend/games/upload',
            secureuri:false,
            fileElementId:'input' + count,//file标签的id
            dataType: 'json',//返回数据的类型
            data:{oldImg: oldImg, from: obj},//一同上传的数据
            success: function (data, status) {
                if (data != '') {
                    //把图片替换
                    var obj = jQuery.parseJSON(data);
                    $("#img"+count).attr("src", obj.path_name);
                    $('#hiddenImg'+count).val(obj.path_name);
                    $('#img'+count).next('.cole').css('display', 'block');

                    if(obj.error != 0) {
                        alert(obj.error);
                    }
                }
            },
            error: function (data, status, e) {
                alert(e);
            }
        });
    }
</script>