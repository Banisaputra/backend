<?php
function format_currency($number) {
    return 'Rp ' . number_format($number, 0, '', '.');
}

function clean_money_formatter($number) {
    return preg_replace('/[^0-9]/', '', $number);
}

function notify($type, $message) {
    Session::flash('notify', compact('type', 'message'));
}

function convert_collection_to_select_options($collection, $label_key, $value_key) {
    return $collection->map(function($option) use ($label_key, $value_key) {
        return [
            'label' => $option[$label_key],
            'value' => $option[$value_key],
        ];
    });
}

function get_cache($key, $defaultValue = null) {
    return \App\Models\Setting::get($key, $defaultValue);
}

function get_file($path = null) {
    if (!$path) {
        return ['exist' => false];
    }
    
    $isStorageFile = \Storage::exists($path);
    $isPublicFile = \File::exists(public_path($path));

    if (!$isStorageFile && !$isPublicFile) {
        return ['exist' => false];
    }

    $storageType = $isStorageFile ? 'storage' : 'public';

    return [
        'exist' => true,
        'name' => basename($path),
        'type' => $storageType,
        'path' => $storageType === 'storage' ? \Storage::url($path) : $path,
        'size' => $storageType === 'storage' ? \Storage::size($path) : \File::size(public_path($path)),
    ];
}

function group_collection_by_key($collection, $key) {
    return collect($collection->reduce(function ($acc, $item) use ($key) {
        if (!array_key_exists($item[$key], $acc)) {
            $acc[$item[$key]] = [];
        }

        array_push($acc[$item[$key]], $item);
        return $acc;
    }, []));
}
