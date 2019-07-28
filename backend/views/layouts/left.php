<?php 
use common\models\Todo;
use yii\helpers\Url;
use backend\modules\jeb\models\Menu as JebMenu;
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@backend/views/myasset');
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?=$directoryAsset ?>/img/user.png" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>
				<?php 
		  $str = Yii::$app->user->identity->fullname;
		  if (strlen($str) > 10)
		$str = substr($str, 0, 17) . '...';
		  echo $str;
		  ?>
				
				</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
		

        <?=common\models\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Main Menu', 'options' => ['class' => 'header']],
					
					['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/site/index'],],
					
					['label' => 'My Project', 'icon' => 'cubes', 'url' => ['/apps/project/index'],],
							
					['label' => 'My Collaboration', 'icon' => 'users', 'url' => ['/apps/project/colla'],],
					


					
					[
                        'label' => 'User Management',
                        'icon' => 'lock',
						'visible' => Todo::can('sysadmin'),
                        'url' => '#',
                        'items' => [
						
							['label' => 'User Assignment', 'icon' => 'user', 'url' => ['/user/assignment'],],
							
							//['label' => 'User Signup', 'icon' => 'plus', 'url' => ['/admin/user/signup'],],
							
							
							/* ['label' => 'User Assignment', 'icon' => 'user', 'url' => ['/admin'],], */
						
                            ['label' => 'Role List', 'icon' => 'user', 'url' => ['/admin/role'],],
							
							['label' => 'Route List', 'icon' => 'user', 'url' => ['/admin/route'],],
							
	
							

                        ],
                    ],
					
					//['label' => 'Change Password', 'icon' => 'lock', 'url' => ['/user/change-password']],
					
					['label' => 'Log Out', 'icon' => 'arrow-left', 'url' => ['/site/logout'], 'template' => '<a href="{url}" data-method="post">{icon} {label}</a>']
					



					


                ],
            ]
        ) ?>

    </section>

</aside>
