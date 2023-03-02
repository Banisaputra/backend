<?php

return [
    [
        [
            'title' => 'Nama Situs',
            'rules' => 'required|max:50',
            'component' => 'text-input',
            'attributes' => [
                'name' => 'site_name',
                'type' => 'text',
            ],
        ],
        [
            'title' => 'Nama Situs (Short)',
            'rules' => 'nullable|string|max:25',
            'component' => 'text-input',
            'attributes' => [
                'name' => 'site_name_short',
                'type' => 'text',
            ],
        ],
        [
            'title' => 'Subheading',
            'rules' => 'nullable|string|max:25',
            'component' => 'text-input',
            'attributes' => [
                'name' => 'subheading',
                'type' => 'text',
            ],
        ],
        [
            'title' => 'Address',
            'rules' => 'nullable|string|max:500',
            'component' => 'text-area',
            'attributes' => [
                'name' => 'address',
                'rows' => 5,
            ],
        ],
        [
            'title' => 'Jumlah Post per Halaman',
            'rules' => 'nullable|integer|min:1|max:50',
            'component' => 'text-input',
            'defaultValue' => 12,
            'attributes' => [
                'type' => 'number',
                'name' => 'post_per_page',
                'class' => 'w-20 !pr-4',
            ],
        ],
        [
            'title' => 'Membership',
            'rules' => 'boolean',
            'component' => 'checkbox-boolean',
            'defaultValue' => false,
            'attributes' => [
                'label' => 'Siapapun dapat mendaftar',
                'name' => 'anyone_can_register',
            ],
        ],
        [
            'title' => 'Default User Role',
            'rules' => 'nullable',
            'component' => 'select',
            'attributes' => [
                'name' => 'default_user_role',
            ],
            'options' => [
                'model' => App\Models\Role::class,
                'label_key' => 'display_name',
                'value_key' => 'name',
            ]
        ],
        [
            'title' => 'Date Time Format',
            'rules' => 'nullable',
            'component' => 'text-input',
            'defaultValue' => 'd F Y H:i',
            'attributes' => [
                'type' => 'text',
                'name' => 'date_time_format',
                'placeholder' => 'd F Y H:i',
            ],
        ],
    ],
    [
        [
            'title' => 'Nomor Telepon',
            'rules' => 'string|nullable|max:24',
            'component' => 'text-input',
            'attributes' => [
                'type' => 'text',
                'name' => 'phone_number',
            ],
        ],
        [
            'title' => 'Facebook',
            'rules' => 'string|nullable|max:255',
            'component' => 'text-input',
            'icon' => '/icons/facebook.png',
            'attributes' => [
                'type' => 'text',
                'name' => 'social_facebook',
                'placeholder' => 'https://www.facebook.com/username',
            ],
        ],
        [
            'title' => 'Instagram',
            'rules' => 'string|nullable|max:255',
            'component' => 'text-input',
            'icon' => '/icons/instagram.png',
            'attributes' => [
                'type' => 'text',
                'name' => 'social_instagram',
                'placeholder' => 'https://www.instagram.com/username',
            ],
        ],
        [
            'title' => 'TikTok',
            'rules' => 'string|nullable|max:255',
            'component' => 'text-input',
            'icon' => '/icons/tik-tok.png',
            'attributes' => [
                'type' => 'text',
                'name' => 'social_tiktok',
                'placeholder' => 'https://www.tiktok.com/@username',
            ],
        ],
        [
            'title' => 'YouTube',
            'rules' => 'string|nullable|max:255',
            'component' => 'text-input',
            'icon' => '/icons/youtube.png',
            'attributes' => [
                'type' => 'text',
                'name' => 'social_youtube',
                'placeholder' => 'https://www.youtube.com/channel/UsAIJi2AKJkxC0gyIJn-4w',
            ],
        ],
        [
            'title' => 'Twitter',
            'rules' => 'string|nullable|max:255',
            'component' => 'text-input',
            'icon' => '/icons/twitter.png',
            'attributes' => [
                'type' => 'text',
                'name' => 'social_twitter',
                'placeholder' => 'https://www.twitter.com/username',
            ],
        ],
    ],
    [
        [
            'title' => 'Logo',
            'rules' => 'nullable|image|max:512',
            'component' => 'file-input',
            'defaultValue' => '/logoipsum-logo-64.svg',
            'attributes' => [
                'name' => 'logo',
                'accept' => 'image/*',
                'helperText' => 'JPG, JPEG, PNG, BMP, GIF, SVG, or WEBP. Max File Size: 512KB',
            ],
        ],
        [
            'title' => 'Tampilkan Nama Situs Disamping Logo?',
            'rules' => 'boolean',
            'component' => 'checkbox-boolean',
            'defaultValue' => false,
            'attributes' => [
                'label' => 'Tampilkan',
                'name' => 'show_site_name_on_logo',
            ],
        ],
        [
            'title' => 'Favicon',
            'description' => 'Ikon utama yang muncul pada laman web.',
            'rules' => 'nullable|image|max:256',
            'component' => 'file-input',
            'defaultValue' => '/logoipsum-logo-64.svg',
            'attributes' => [
                'name' => 'favicon',
                'accept' => 'image/*',
                'helperText' => 'JPG, JPEG, PNG, BMP, GIF, SVG, or WEBP. Max File Size: 256KB',
            ],
        ],
        [
            'title' => 'Hero Shot',
            'description' => 'Foto utama yang ditampilkan di halaman utama situs web.',
            'rules' => 'nullable|image||max:1024',
            'component' => 'file-input',
            'attributes' => [
                'name' => 'hero_shot',
                'accept' => 'image/*',
                'helperText' => 'JPG, JPEG, PNG, BMP, GIF, SVG, or WEBP. Max File Size: 1MB',
            ],
        ],
    ],
    [
        [
            'title' => 'Pencarian KWT',
            'rules' => 'boolean',
            'component' => 'checkbox-boolean',
            'defaultValue' => false,
            'attributes' => [
                'label' => 'Tampilkan untuk umum?',
                'name' => 'show_kwt_search',
            ],
        ],
    ],
];
