<div class="adminpage-default-index">
    <div role="form">
        <?php
            use kartik\tabs\TabsX;

            $items = [
                [
                    'label'   => 'Вконтакте',
                    'content' => \common\modules\statistics\widgets\StatisticsVK::widget(),
                ],
                [
                    'label'   => 'Instagram',
                    'content' => \common\modules\statistics\widgets\StatisticsInstagram::widget(),
                ],
                [
                    'label'   => 'Twitter',
                    'content' => \common\modules\statistics\widgets\StatisticsTwitter::widget(),
                ],
                [
                    'label'   => 'Ask',
                    'content' => \common\modules\statistics\widgets\StatisticsAsk::widget(),
                ],
            ];
            echo TabsX::widget([
                'items'        => $items,
                'position'     => TabsX::POS_ABOVE,
                'encodeLabels' => false
            ]);
        ?>
    </div>
</div>
