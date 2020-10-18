<?php 
                 foreach ($tb_slide as $list) { ?>
                     <?php if ($list['Slide'] == 'gambar') { ?>
                         <img durasi="3" tipe="<?=$list['Slide']?>" class="slider w3-animate-top" src="<?=base_url().$list['View']?>" width="100%" height="100%">
                    <?php } ?>
                    <?php if ($list['Slide'] == 'video') { ?>
                        <video durasi="15" tipe="<?=$list['Slide']?>" class="slider w3-animate-top" style="width:100%;height:auto;"  >
                            <source src="<?=base_url().$list['View']?>" type="video/mp4">
                        </video>
                    <?php } ?>
            <?php } ?>