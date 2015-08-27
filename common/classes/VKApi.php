<?php

    namespace common\classes;

    class VKApi
    {
        const API_VERSION = 5.37;

        /**
         * @param string $groupUrl
         *
         * @return mixed
         */
        public static function getGroupIdByUrl($groupUrl)
        {
            $groupName = basename($groupUrl);

            $group = json_decode(file_get_contents('https://api.vk.com/method/groups.getById?v=5.37&group_id=' . $groupName),
                                 true);

            return self::hasError($group) ? false : $group['response'][0]['id'];
        }

        private static function hasError($array)
        {
            return isset($array['error']);
        }

        /**
         * @param integer $id
         *
         * @return mixed
         */
        public static function getWallPosts($id)
        {
            $wall = json_decode(file_get_contents('https://api.vk.com/method/wall.get?v=5.37&count=100&filter=owner&owner_id=-' . $id),
                                true);

            return self::hasError($wall) ? false : $wall['response']['items'];
        }
    }