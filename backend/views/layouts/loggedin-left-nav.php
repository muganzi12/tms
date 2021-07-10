<?php

use yii\helpers\Url;
?>
<ul class="nav" >
    <li class="nav-label">Main Menu</li>
 
    <li class="nav-item">
        <a href="" class="nav-link with-sub"><i class="typcn typcn-document"></i>Account Management</a>
        <ul class="nav-sub">
            <li class="nav-sub-item">
                <a href="<?= Url::to(['sacco/index']); ?>" class="nav-sub-link">SACCOs</a>
            </li>
            <li class="nav-sub-item">
                <a href="<?= Url::to(['user/index']); ?>" class="nav-sub-link">System Users</a>
            </li>
          
        </ul>
    </li>
  
    <li class="nav-item">
        <a href="/" class="nav-link with-sub"><i class="typcn typcn-clipboard"></i>Master Data</a>
        <ul class="nav-sub">
            <li class="nav-sub-item"><a href="<?= Url::to(['master/index']); ?>" class="nav-sub-link">`Master</a>
            </li>
            <li class="nav-sub-item"><a href="<?= Url::to(['master/create']); ?>" class="nav-sub-link">New Master Record</a>
            </li>

        </ul>
    </li>
</ul><!-- nav -->