<h2 class="pristupnost">Akcie aktívneho rozvrhu</h2>
<ul id="rozvrh_akcie">

    <?php

        if($published_slug) {
            echo '<li id="menuUnpublish">';
            echo link_to($published_slug, '@timetable_show_published?slug='.$published_slug);
            echo '</li><li>';
            echo link_to(' ', '@timetable_unpublish?id='.$timetable_id, array('rel' => 'nofollow'));
        }
        else {
            echo '<li id="menuPublish">';
            echo link_to(' ', '@timetable_publish?id='.$timetable_id, array('rel' => 'nofollow'));

        }
    echo '</li>';
        ?>
    <!--
    --><li id="menuSave"><?php echo link_to(' ', '@timetable_save?id='.$timetable_id, array('rel' => 'nofollow')); ?></li><!--
    --><li id="menuRename"><?php echo link_to(' ', '@timetable_rename?id='.$timetable_id, array('rel' => 'nofollow')); ?></li><!--
    --><li id="menuPrint"><?php echo link_to(' ', '@timetable_rename?id='.$timetable_id, array('rel' => 'nofollow')); ?></li><!--
    --><li id="menuDuplicate"><?php echo link_to(' ', '@timetable_duplicate?id='.$timetable_id, array('rel' => 'nofollow')); ?></li><!--
    --><li id="menuImport"><?php echo link_to(' ', '@timetable_import?id='.$timetable_id, array('rel' => 'nofollow')); ?></li><!--
    --><li id="menuExport"><?php echo link_to(' ', '@timetable_export?id='.$timetable_id, array('rel' => 'nofollow')); ?></li><!--
    --><li id="menuDelete"><?php echo link_to(' ', '@timetable_delete?id='.$timetable_id, array('rel' => 'nofollow')); ?></li>
    <!--mena tlacidiel backup: Zdielať Uložiť Premenovať Tlacit Duplikovať Importovať Exportovať Zmazať-->
</ul>
