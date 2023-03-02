@extends('layouts.default')

@section('title', 'Peta Kerawanan Pangan')

@php
  $colors = ['#640000', '#ff3737', '#ff9b9b', '#a7ffa7', '#19ff19', '#003a00'];
@endphp

@section('content')
<div class="container px-6 pt-16 pb-24 mx-auto">
  <div class="flex flex-col text-center w-full mb-20">
    <h1 class="text-2xl lg:text-3xl font-semibold mb-2.5 !leading-normal">
      Peta Indikator Kerawanan Pangan
    </h1>
    <div class="text-base font-light mx-12 lg:w-full md:w-full sm:w-3/6 sm:mx-auto">
      <span>Terakhir diperbarui: </span>
      @if ($lastUpdated)
        <span class="block mt-1.5 ml-2 md:inline-block md:mt-0 font-medium border border-green-500 rounded-md py-1.5 px-2.5 text-sm text-green-500">
          {{ $lastUpdated }}
        </span>
        @else
        -
      @endif
    </div>
  </div>
  <div class="mb-10">
      <div class="w-full h-[600px] mb-20">
<svg
   id="peta"
   class="mx-auto"
   version="1.0"
   width="500.000000pt"
   height="500.000000pt"
   viewBox="0 0 500.000000 500.000000"
   preserveAspectRatio="xMidYMid meet"
   xmlns="http://www.w3.org/2000/svg"
   xmlns:svg="http://www.w3.org/2000/svg"
   fill="#CFD0D1">
   <style>
      path:hover {
         opacity: 0.5;
      }
   </style>
  <path
     d="m 334.5,403.375 c 1,2.6 7.7,6.4 11.2,6.5 2.7,0 2.9,1.4 0.6,5.9 -1.8,3.7 -1.9,4.7 -0.9,8.3 0.7,2.2 0.9,4.4 0.4,4.9 -0.4,0.4 -2.9,1.3 -5.4,2 -4.2,1.1 -4.8,1 -9,-1.4 -3.5,-2.1 -5.9,-2.7 -10.2,-2.7 -3.1,0 -5.9,-0.5 -6.3,-1.1 -0.7,-1.1 -7.8,-0.8 -14.9,0.6 l -3,0.7 0.3,-4.6 c 0.3,-3.5 0,-4.7 -1.2,-5.2 -2.7,-1 -1.8,-2.3 2.4,-3.4 3.7,-1 6.9,-4.2 8.3,-8.5 0.3,-0.6 0.9,-0.6 1.8,0.1 0.8,0.7 3,1.4 4.9,1.7 1.9,0.2 4.9,1 6.6,1.7 4.6,2 7.8,0.7 9.9,-4 2.1,-4.6 3.2,-5 4.5,-1.5 z"
     id="path1249"
     district="Sawit" />
  <path
     d="m 139.9,387.975 c 12.2,4.1 17.6,7.3 17.6,10.4 0,1.4 0.3,2.5 0.8,2.5 0.4,0 3.3,2.2 6.4,4.8 10.3,8.4 11.8,9.4 15.4,9.7 1.9,0.2 4.8,1.5 6.5,2.9 1.7,1.5 7.4,4.7 12.6,7.2 5.8,2.8 9.1,5 8.6,5.5 -0.5,0.5 -3.9,2.9 -7.4,5.2 -5.9,3.9 -6.4,4.5 -6.3,7.7 0,1.9 0.2,4.1 0.5,4.9 0.2,0.8 -0.8,1.7 -2.6,2.3 -1.6,0.6 -4.6,2.6 -6.5,4.4 -3.7,3.5 -6.7,4.2 -10,2.4 -1,-0.6 -5.1,-6.9 -9.1,-14 -7,-12.8 -7.3,-13.1 -14.3,-17.6 -4.4,-2.9 -11.7,-9.4 -19.1,-17 -6.6,-6.9 -14,-13.8 -16.4,-15.4 l -4.5,-2.9 6.5,-3.1 c 3.5,-1.6 7.7,-3 9.3,-3 1.5,0 6.9,1.4 12,3.1 z"
     id="path1247"
     district="Tamansari" />
  <path
     d="m 197.9,377.375 c 2.7,1.9 7.3,4.1 10.3,5 5.2,1.5 5.6,1.5 12.6,-0.9 5.2,-1.8 7.5,-2.2 8.4,-1.4 1.7,1.3 1.7,6 0.1,8 -2.2,2.5 -8.4,5.8 -11.2,5.8 -1.5,0 -3.6,0.5 -4.6,1 -1.2,0.7 -2.7,0.7 -4.5,0 -2.2,-0.8 -2.7,-0.7 -3.7,1.5 -1,2.3 -0.8,2.9 2.2,6 3.3,3.4 3.3,3.5 2.2,8.5 -1,4.4 -0.9,5.8 0.9,11.1 1.2,3.3 1.9,6.2 1.7,6.5 -0.8,0.8 -19.3,-8.8 -24.6,-12.7 -3.7,-2.8 -5.9,-3.8 -7.2,-3.4 -1.3,0.4 -3,-0.1 -4.8,-1.5 -14.8,-11.4 -15,-11.6 -14.1,-13.2 1.3,-2.4 -8.1,-7.8 -21.5,-12.3 -10,-3.4 -11.1,-3.6 -15.4,-2.5 -2.6,0.6 -7.1,2.4 -10.1,4 -4.2,2.3 -5.7,2.7 -7.3,1.9 -2,-1.1 -2,-1.1 0.1,-3.3 1.2,-1.3 3.2,-2.8 4.4,-3.4 1.2,-0.5 5.3,-2.5 9,-4.2 l 6.9,-3.2 3.1,2.3 c 2.6,1.9 4.2,2.3 8.9,2.1 5,-0.2 6.9,0.3 14.3,3.9 9.5,4.7 10.9,4.5 12.1,-1.8 l 0.6,-3.4 2.2,2 c 2.8,2.6 4.3,2.6 8.1,0.1 1.8,-1.2 4.7,-2 7.1,-2 2.8,0 4.7,-0.6 5.9,-2 1,-1.1 2.1,-2 2.4,-2 0.3,0 2.8,1.6 5.5,3.5 z"
     id="path1245"
     district="Musuk" />
  <path
     d="m 328.9,359.275 c 1.8,0.7 4.3,2.7 5.4,4.4 1.2,1.6 4,3.7 6.1,4.6 2.4,0.9 4.6,2.7 5.5,4.3 1.6,3 10.4,11.7 12.6,12.5 1,0.3 0.7,1.4 -1.2,4.9 -1.5,2.4 -2.9,6 -3.3,7.9 -1.4,7.7 -2.6,10 -4.8,9.9 -4.5,-0.1 -11,-3.4 -12.7,-6.4 -2.7,-4.9 -5.5,-4.5 -8.5,1.4 -1.4,2.8 -2.9,5.1 -3.4,5.1 -0.5,0 -2.8,-0.9 -5.2,-1.9 -2.4,-1.1 -4.7,-1.7 -5.1,-1.5 -1.7,1.1 -4.7,-0.8 -7.2,-4.6 -2.2,-3.3 -2.6,-5.1 -2.6,-10.8 0,-4.4 -0.5,-7.5 -1.5,-8.8 -2.6,-3.5 -1.9,-5.4 2.1,-5.4 1.9,0 4.4,-0.4 5.4,-1 2.4,-1.3 4.3,-7.2 3.5,-11 -0.4,-1.6 -0.4,-3.4 0,-4 0.9,-1.5 11,-1.2 14.9,0.4 z"
     id="path1243"
     district="Banyudono" />
  <path
     d="m 295.7,347.875 c 1.9,0 4,1.2 6.6,3.7 2,2.1 5,4.6 6.5,5.6 2.3,1.5 2.7,2.4 2.7,6.5 0,6.2 -1.6,8.2 -6.8,8.9 -6.1,0.8 -7,2.4 -4.4,7.9 1.8,3.6 2.1,5.5 1.6,9.7 -0.5,4.3 -0.2,5.9 1.4,8.6 1.6,2.7 1.8,3.9 1,6.2 -1.2,3.5 -5.3,6.9 -8.2,6.9 -4.5,0 -6.2,4.7 -2.6,7.1 1.6,1.2 1.8,2 1.2,4.9 -0.7,3.1 -1.1,3.5 -3.8,3.2 -1.6,-0.1 -7.2,-1.5 -12.4,-3.1 l -9.5,-2.8 0.3,-3.3 c 0.2,-2.3 1.5,-4.7 4.2,-7.6 2.2,-2.4 4,-5.2 4,-6.1 0,-1 -1.1,-5.4 -2.4,-9.8 -2.3,-7.8 -2.3,-8.1 -0.6,-11.4 1.4,-2.8 2.6,-3.7 6,-4.5 2.7,-0.7 5.1,-2.1 6.4,-3.9 1.9,-2.6 1.9,-2.9 0.3,-5.6 -2.2,-3.8 -2.2,-4.5 0.8,-6.1 2.9,-1.5 3.2,-3.6 1,-6 -1.4,-1.6 -1.4,-2.1 0.5,-5.3 1.2,-2 1.8,-4.2 1.4,-4.9 -0.5,-1 -0.4,-1.1 0.7,-0.1 0.7,0.7 2.6,1.3 4.1,1.3 z"
     id="path1241"
     district="Teras" />
  <path
     d="m 281,347.975 c 0.5,0.5 2.2,0.9 3.7,0.9 2.8,0 3.7,1.3 1.8,2.5 -0.5,0.3 -1,1.9 -1,3.5 0,1.6 0.5,3.2 1,3.5 1.6,1 1.1,2.1 -1.5,3.3 -2.9,1.4 -3.1,3.3 -0.8,7.3 2.3,3.8 0.9,6.3 -3.8,6.7 -3.9,0.4 -7.2,3.1 -9,7.4 -1,2.5 -0.8,4.4 1.2,12.3 l 2.3,9.5 -3.1,3.2 c -3.7,3.9 -5.3,6.9 -5.3,9.7 0,1.2 -0.3,2.1 -0.6,2.1 -0.3,0 -3.8,-1.4 -7.7,-3.2 -4.8,-2.1 -8.9,-3.2 -12.2,-3.2 l -5,-0.1 -0.5,6.5 -0.5,6.5 -5.5,-0.3 c -3,-0.1 -7.9,-1 -10.9,-1.9 -5.3,-1.6 -5.4,-1.6 -7.1,0.4 -1.7,2.1 -1.7,2.1 -3.3,-3.1 -1.2,-3.7 -1.5,-7 -1.1,-11.6 0.6,-6.1 0.4,-6.7 -2,-8.9 -1.4,-1.4 -2.6,-2.7 -2.6,-3 0,-0.3 1.7,-0.7 3.8,-0.8 6.7,-0.3 11.6,-1.5 15.4,-3.9 2.1,-1.3 4.1,-2.4 4.6,-2.4 0.5,0 2.8,1.3 5.3,2.9 4.4,2.9 6.1,3.4 11.2,3.2 4,-0.2 6.7,-5 6.7,-12.4 0,-9.5 3.5,-21.6 7.5,-25.7 4.4,-4.5 5.7,-8 4.5,-12.1 -0.5,-1.7 -0.7,-3.5 -0.4,-4 0.5,-0.8 13.2,3.6 14.9,5.2 z"
     id="path1239"
     district="Mojosongo" />
  <path
     d="m 219.3,338.975 c 1.7,0.6 3.3,1.7 3.6,2.5 1.9,5.1 19.6,5.9 19.6,0.9 0,-2.2 18.6,-3.4 20.5,-1.3 0.2,0.2 0.6,2.6 1,5.5 0.7,5.1 0.6,5.3 -3.6,9.7 -3.7,4.1 -4.5,5.9 -6.5,14.4 -1.3,5.3 -2.4,12 -2.4,14.7 0,9.6 -4.8,12 -12.9,6.5 -2.4,-1.7 -4.8,-3 -5.3,-3 -0.4,0 -0.8,-2.2 -0.8,-4.9 0,-3.9 -0.5,-5.3 -2.1,-6.4 -1.8,-1.3 -2.8,-1.2 -8.7,0.8 -3.7,1.3 -6.8,2.1 -7,2 -0.2,-0.2 0.4,-1.7 1.2,-3.4 2.5,-4.8 2.1,-8.2 -1.4,-11.1 l -3.1,-2.5 3.6,-5 c 3.9,-5.6 4.2,-7 1.8,-9.7 -2.2,-2.5 -4.1,-2.3 -11.3,1.3 -6.3,3.1 -9,3.2 -9,0.4 0,-1 1,-1.5 2.8,-1.5 4.3,0 11.4,-2.5 12.8,-4.5 0.8,-1 1.1,-2.9 0.8,-4.2 -0.7,-2.7 1.2,-3 6.4,-1.2 z"
     id="path1237"
     district="Boyolali" />
  <path
     d="m 393.2,329.875 c 6.9,0 7.2,0.1 9.5,3.2 2.1,3.1 2.3,4.2 2.3,17.8 v 14.4 l -4.5,0.9 c -2.5,0.4 -8.4,0.5 -13.2,0.2 -10.6,-0.8 -12.4,0 -13.5,5.7 -0.8,3.8 -1.3,4.4 -4.8,5.6 -2.2,0.7 -5.4,2 -7.1,2.9 -3.6,1.7 -6.8,0.6 -7.9,-2.6 -0.3,-1.1 -1.4,-2.3 -2.4,-2.6 -0.9,-0.3 -2.5,-2.1 -3.4,-4 -1.2,-2.5 -3,-4.1 -6,-5.4 -5.8,-2.5 -7.5,-4.6 -5.5,-6.9 2.2,-2.5 4.8,-7.8 4.8,-9.9 0,-3.4 2,-9.1 3.5,-9.6 0.7,-0.3 3.3,0.7 5.7,2.3 2.4,1.6 5,3 5.9,3 0.9,0 2,0.7 2.3,1.6 0.8,2.2 2.1,1.5 4.8,-2.6 2.4,-3.4 2.5,-3.5 9.3,-3.5 8,0 8.9,-1.1 6,-7.6 -1,-2.1 -1.5,-4.5 -1.2,-5.4 0.6,-1.3 1.1,-1.3 4.4,0.5 2.8,1.5 5.7,2 11,2 z"
     id="path1235"
     district="Ngemplak" />
  <path
     d="m 194.5,321.375 c 1,1.2 0.8,2.2 -0.9,5 -2.8,4.8 -2.7,8 0.4,11.1 2.3,2.3 3.1,2.5 7.3,1.9 8.8,-1.2 8.7,-1.2 9,1.7 0.3,2.3 -0.2,2.8 -3.5,3.7 -2.1,0.6 -5.2,1.1 -7,1.1 -3.2,0 -6.3,2.1 -6.3,4.3 0,2 3,5.7 4.6,5.7 0.8,0 4.2,-1.4 7.6,-3 10.5,-5.2 12.3,-3.7 6.1,5.5 l -3.6,5.6 3.7,3.4 3.7,3.4 -1.6,3.8 c -0.9,2.1 -1.9,4.3 -2.2,5 -0.6,1.6 -8.8,-1.4 -13.5,-5.1 -4.2,-3.1 -7.8,-3.3 -10.3,-0.6 -1.2,1.4 -3.1,2 -5.8,2 -2.1,0 -5.2,0.7 -6.7,1.7 -2.7,1.5 -2.9,1.5 -5.6,-0.6 l -2.9,-2.2 -1.7,2.1 c -1,1.2 -1.8,3 -1.8,4.1 0,3.2 -1.7,3 -10.2,-1.2 -7.3,-3.5 -8.9,-4 -13.2,-3.5 -3.8,0.4 -5.5,0.1 -7.6,-1.4 -3.6,-2.5 -6.1,-2.5 -11.1,0.1 -2.3,1.1 -4.3,1.8 -4.5,1.6 -0.6,-0.6 8.6,-6.7 14.3,-9.5 7.4,-3.8 10.1,-9.2 6.7,-14 -1.5,-2.1 -1.4,-2.2 1.5,-2.2 1.7,0 5.1,0.5 7.5,1.2 3.6,0.9 5.1,0.9 8.2,-0.3 4.5,-1.7 6.4,-4.8 6.4,-10.4 0,-3.8 3.1,-10.5 4.7,-10.5 0.5,0 2.7,0.7 5.1,1.5 2.4,0.8 5.4,1.2 6.8,0.9 2.7,-0.7 6.4,-5.7 6.4,-8.6 0,-4.1 7.3,-6.6 10,-3.3 z"
     id="path1233"
     district="Cepogo" />
  <path
     d="m 105.8,310.075 c 3.6,2.4 8.6,5.5 11.3,7.1 2.7,1.5 6.8,4.1 9.1,5.9 5.1,3.8 11.3,4.6 21.9,2.8 6.7,-1.2 7.8,-1.1 11.4,0.5 4.6,2.1 4.8,2.7 2,6.2 -1.1,1.5 -2.2,4.9 -2.6,8.5 -1,8.5 -2.6,9.4 -14.6,7.9 -10.4,-1.4 -11.7,-0.8 -9.4,3.7 0.9,1.7 1.6,4 1.6,5.1 0,2.4 -4.6,6.4 -11.2,9.7 -2.7,1.4 -8.8,6.1 -13.5,10.4 l -8.5,8 -3.9,-3.5 c -2.1,-1.9 -5.5,-4.3 -7.7,-5.4 -2.1,-1.1 -6.1,-3.7 -8.8,-5.9 -7.3,-5.8 -9.2,-6.6 -16.9,-7.3 -3.8,-0.3 -10.1,-1.4 -14,-2.4 l -6.9,-1.9 3.3,-1.4 c 1.9,-0.7 4.8,-2.4 6.5,-3.6 2,-1.5 5.1,-2.5 8.7,-2.9 8.4,-0.8 12,-3.1 18.3,-12.1 7.1,-9.8 9,-13.6 11.5,-22.4 2.1,-7.8 3.7,-11.2 5.1,-11.2 0.6,0 3.8,1.9 7.3,4.2 z"
     id="path1231"
     district="Selo" />
  <path
     d="m 301.8,295.775 2.9,0.6 -3.1,3.9 c -1.7,2.1 -3.1,5 -3.1,6.3 0,2.5 4,7.3 6.1,7.3 2.5,0 10,-4.2 11,-6.3 1.1,-1.9 1.2,-1.9 2.1,-0.3 0.7,1.3 2,1.7 4.9,1.5 2.3,-0.2 4.3,0.2 4.7,0.9 0.4,0.6 3.9,2.8 7.7,4.9 5.8,3.2 7.7,5 12.6,11.8 5.1,7.1 9.6,15.5 8.3,15.5 -0.3,0 -2.2,-1.1 -4.2,-2.5 -6.9,-4.7 -10.6,-2.6 -12.3,7.2 -0.6,3.4 -2,7.2 -3.3,8.8 -2.1,2.6 -2.5,2.7 -5.6,1.7 -1.8,-0.7 -7.1,-1.2 -11.7,-1.2 -8.2,0 -8.5,-0.1 -11.6,-3.3 -1.8,-1.7 -4.5,-4.2 -6.1,-5.4 -1.7,-1.3 -3.6,-4.3 -4.6,-7.1 -1.5,-4.3 -1.6,-5.3 -0.3,-8.3 2.5,-6.1 1.6,-8.1 -5.2,-10.6 -3.3,-1.2 -8,-2.2 -10.5,-2.3 -5.8,-0.1 -7.2,-1 -6.8,-4.5 0.2,-2.3 1.1,-3.1 4.3,-4.2 7,-2.4 10.9,-7.8 6.5,-9 -3.2,-0.8 -2.4,-1.9 3.3,-4.1 5.3,-2.1 9,-2.5 14,-1.3 z"
     id="path1229"
     district="Sambi" />
  <path
     d="m 223.7,293.775 c 4.4,4.4 4.8,5.2 4.1,7.8 -0.4,1.5 -0.7,4.7 -0.7,7 0.1,4.1 0,4.3 -2.7,4.3 -3.5,0 -5.3,2.8 -4,6.2 1,2.6 11,11.6 16.5,14.9 3.2,1.9 3.7,2.6 3.4,5.3 -0.3,3 -0.4,3.1 -6.1,3.4 -5.4,0.3 -6.1,0.1 -9.6,-3.1 -4.5,-4.1 -10.1,-5.2 -18,-3.7 -8.1,1.5 -9.9,1.3 -11.7,-1.5 -1.5,-2.3 -1.5,-2.7 0.5,-5.8 4.7,-7.6 0.8,-12.3 -8.7,-10.6 -5,1 -5.7,0.7 -4.8,-1.7 0.5,-1.4 1.6,-1.5 7,-0.9 4.3,0.4 6.6,0.3 7.1,-0.5 0.4,-0.6 -2.3,-5.6 -5.9,-11.2 -3.6,-5.5 -6.6,-10.9 -6.6,-12 0,-2 0,-2 3.3,-0.1 1.7,1 4.7,4.1 6.5,6.8 1.8,2.8 4.2,5.4 5.2,5.9 2.6,1.2 6.3,-1.4 10.3,-7.2 4.3,-6.1 6.4,-8.2 8.3,-8.2 0.9,0 3.9,2.2 6.6,4.9 z"
     id="path1227"
     district="Ampel" />
  <path
     d="m 397,276.575 c 0.4,2 2.2,5 4.5,7.3 3.9,3.9 4.1,5 0.9,5 -1,0 -2.3,0.9 -2.9,2.1 -0.9,1.6 -0.7,2.8 0.9,6 2.7,5 2.6,8.8 0,14.9 -1.5,3.4 -2,6.4 -1.8,9.9 l 0.4,5.1 h -6.9 c -5.3,0 -7.7,-0.5 -10.3,-2.1 -3.2,-2 -3.6,-2 -5,-0.6 -2,2 -1.9,6.6 0.2,10.6 l 1.6,3.1 -6.6,-0.2 c -6.4,-0.3 -6.7,-0.2 -9.4,3 l -2.7,3.3 -2.3,-5.5 c -1.2,-3 -4.8,-9.2 -7.9,-13.7 -5,-7.2 -6.5,-8.6 -12.7,-11.8 -4.1,-2.2 -7.1,-4.5 -7.3,-5.5 -0.3,-1.6 0.1,-1.8 2.5,-1.3 9.6,2 9,2.1 14,-1.9 11.3,-9 13.5,-12.4 9.7,-15.5 -1.3,-1 -2.7,-1 -7.6,0 -6.1,1.2 -9.2,0.5 -6.6,-1.6 0.7,-0.6 5.7,-2.5 11.1,-4.3 7.5,-2.4 10.8,-3.1 13.8,-2.6 5.7,0.9 8.6,-0.1 10.8,-4 1.9,-3.1 2.5,-3.4 6.8,-3.5 2.6,0 5.7,-0.4 6.8,-0.8 2.9,-1.1 5.2,0.7 6,4.6 z"
     id="path1225"
     district="Nogosari" />
  <path
     d="m 133.1,266.775 c 1.4,1.1 5.3,2.9 8.8,4.1 7.8,2.5 13.7,7.5 17.8,14.7 4,7.1 6,8 13.1,5.9 7.2,-2.1 7.4,-2.1 8,1.1 0.3,1.6 3.1,6.5 6.1,11.1 3.1,4.6 5.6,8.5 5.6,8.8 0,0.2 -2.6,0.3 -5.7,0.2 -5.3,-0.3 -5.8,-0.1 -7,2.4 -1.5,3 -0.8,5.8 1.4,5.8 1.8,0 1.1,4.1 -1.4,7.9 -1.3,2 -2.1,2.3 -5.3,1.8 -2.1,-0.3 -6.5,-2.1 -9.7,-4.1 -6.4,-4 -9.8,-4.4 -21.1,-2.6 -7.4,1.2 -12.7,0.2 -17,-3.5 -1.6,-1.3 -6.2,-4.3 -10.3,-6.6 -4.1,-2.3 -9.1,-5.5 -11.3,-7.2 l -3.9,-3.1 0.7,-7 c 0.5,-5.9 1.2,-8 4.1,-12.1 6.4,-9.1 13.8,-16.5 18,-18 5.3,-1.9 6.3,-1.8 9.1,0.4 z"
     id="path1223"
     district="Gladagsari" />
  <path
     d="m 364.8,265.875 c -0.5,10.9 -0.1,10.5 -13,14.7 -11.8,3.9 -14.5,5.9 -13,9.7 0.7,1.8 6.3,2.1 11.3,0.7 1.7,-0.5 3.7,-0.5 4.4,-0.1 1.9,1.2 -0.5,4.1 -8.5,10.2 -6.8,5.1 -6.9,5.1 -9.8,3.5 -3.3,-2 -5.8,-2.2 -7.4,-0.6 -0.6,0.6 -2.7,1.4 -4.6,1.9 -3.2,0.7 -3.8,0.5 -5.2,-1.6 -2,-3.2 -3.1,-3 -5,0.6 -2.9,5.6 -10.9,7.8 -12.6,3.4 -0.5,-1.6 0.2,-3.4 2.9,-7.3 4.5,-6.4 3.7,-7.4 -5.9,-7.9 -6.9,-0.4 -7.4,-0.3 -17.8,4.8 -5.8,2.9 -11.8,6.4 -13.3,7.8 l -2.8,2.6 v -2.3 c 0,-3.1 1.6,-5.9 6.6,-11.2 4.8,-5.3 6.3,-10.2 4.6,-15.7 -0.9,-2.9 -0.8,-4.1 0.8,-7.2 2.3,-4.5 3.4,-5 10.7,-5 4,0 6.2,-0.6 8,-2 2.5,-1.9 2.6,-1.9 4.9,-0.1 3.2,2.5 20.4,3.8 27.4,2 4,-1 5.6,-1 8.9,0.1 3.5,1.1 4.3,1.1 6.7,-0.4 1.7,-1.2 3.7,-1.6 5.8,-1.2 2.2,0.4 4.2,-0.1 7.1,-1.8 2.2,-1.4 5.1,-2.4 6.5,-2.3 2.3,0.2 2.5,0.6 2.3,4.7 z"
     id="path1221"
     district="Simo" />
  <path
     d="m 308.4,188.775 c 1.6,2.8 3.9,5.5 5.1,6.1 1.4,0.7 2,2.1 2,4.4 0,1.8 1.2,5.5 2.6,8.1 2.2,4.2 2.4,5.4 1.6,8.8 -0.9,3.4 -0.7,4.5 1.9,9.4 1.6,3 2.9,6.2 2.9,7 0,0.8 -1.3,3.3 -2.9,5.6 -4.7,6.9 -6.9,12 -8.4,19.3 l -1.4,6.9 -4.4,-0.3 c -2.4,-0.2 -5.1,-1 -6,-1.8 -2,-1.8 -4.8,-1.8 -6.8,0 -0.9,0.8 -4.6,1.6 -8.3,1.8 l -6.8,0.4 v -2.9 c 0,-1.5 -0.9,-4.6 -2,-6.8 -1.1,-2.1 -3,-5.8 -4.1,-8.1 -2.6,-4.9 -2.6,-6.8 -0.4,-17.2 1.6,-8.1 1.4,-11.4 -1.3,-20.3 -1.4,-4.7 -1.4,-5.4 0.1,-7.6 1.1,-1.7 2.9,-2.6 6,-3.1 5.2,-0.8 14.2,-5.1 21.7,-10.5 3,-2.1 5.6,-4 5.7,-4 0.1,-0.1 1.5,2.1 3.2,4.8 z"
     id="path1219"
     district="Karanggede" />
  <path
     d="m 400.2,185.575 c 1.5,1.6 3.4,2.3 5.8,2.3 2.2,0 4.7,0.8 6.2,2 3.3,2.6 4.7,2.5 10,-0.5 l 4.3,-2.6 v 4.3 c 0,6.7 -4.6,23.4 -7.5,27.2 -3.5,4.6 -3.3,8.1 0.7,10.6 l 3.2,1.9 -4.4,4.3 c -2.5,2.4 -7.2,6.3 -10.4,8.8 -3.3,2.5 -6.8,5.7 -7.9,7.2 -1.8,2.5 -1.9,3.2 -0.9,8 1.5,6.6 0.4,11.5 -2.4,10.9 -1,-0.2 -3.5,-0.3 -5.4,-0.3 -14,0.2 -12.7,-0.2 -15.5,4.2 -2.2,3.5 -3,4 -6.2,4 h -3.6 l 0.7,-5.3 c 0.4,-2.8 0.9,-8.3 1.3,-12.2 0.4,-4 1.4,-8.3 2.5,-10 2.1,-3.5 2.3,-6.6 0.6,-8.3 -0.9,-0.9 -1.3,-4.8 -1.4,-11.7 l -0.1,-10.4 2.9,-1 c 1.9,-0.7 3.4,-2.2 4.3,-4.5 0.8,-2 2.6,-4.3 4,-5.2 1.7,-1.1 2.5,-2.5 2.5,-4.5 0,-4.2 -2.8,-5.2 -11.7,-4.4 l -7.4,0.7 3.2,-5.9 c 1.8,-3.2 3.3,-5.9 3.4,-6 0.1,-0.2 2.3,-0.7 4.9,-1.2 2.8,-0.5 5.3,-1.7 6.1,-2.8 1.1,-1.6 2.5,-1.9 8.6,-1.9 6.2,0.1 7.7,0.4 9.6,2.3 z"
     id="path1217"
     district="Andong" />
  <path
     d="m 342.1,192.075 c 4.1,2.9 4.2,3.2 4.6,9.5 0.3,4.9 0.9,6.9 2.3,7.9 3.2,2.4 6.7,1.7 10.7,-2.3 3.6,-3.5 4.1,-3.7 12.1,-4.1 9.6,-0.5 11.9,0.7 7.3,4.1 -1.5,1 -3.3,3.4 -4.1,5.3 -0.8,2.1 -2.5,3.8 -4.2,4.5 -1.5,0.5 -3,1.4 -3.3,1.9 -0.3,0.5 -0.5,5.7 -0.3,11.6 0.1,7.7 0.6,11.3 1.8,13 1.5,2.3 1.4,2.6 -1,6.1 -1.4,2.1 -2.5,5 -2.5,6.6 0,2.3 -0.3,2.7 -1.9,2.2 -1.2,-0.3 -4.1,0.5 -7.2,2 -3.7,1.9 -6.1,2.5 -8.2,2.1 -2,-0.4 -3.9,-0.1 -5.5,1 -2.1,1.4 -3.1,1.4 -6.8,0.4 -3.6,-1 -5.1,-1 -9,0.4 -5.1,1.7 -9.2,2 -11,0.8 -1.8,-1.1 0.2,-11.4 3.2,-17.4 1.4,-2.8 3.9,-6.8 5.5,-9.1 1.6,-2.2 2.9,-4.7 2.9,-5.6 0,-0.9 -1.3,-4.1 -3,-7.2 -2.5,-4.9 -2.9,-6.4 -2.3,-10.7 0.4,-4.1 0.2,-5.7 -1.6,-8.5 -1.1,-1.9 -2.1,-4.8 -2.1,-6.6 0,-2.6 0.4,-3.1 2.4,-3.1 1.3,0 3.6,-1 5.1,-2.2 2.5,-1.9 2.7,-2.6 2.2,-6.9 l -0.6,-4.8 5.2,3.1 c 2.9,1.7 7.1,4.4 9.3,6 z"
     id="path1215"
     district="Klego" />
  <path
     d="m 360.3,117.375 c 0.7,1.6 0.8,3.5 0.1,5.7 -1.3,4.8 -1.1,6.5 1.1,8.6 2,1.8 1.9,1.9 -3.1,7.1 -4,4.1 -4.9,5.8 -4.4,7.4 0.3,1.2 1,4.4 1.5,7.2 0.5,2.7 1.2,6.3 1.5,8 0.8,4.3 -2.3,10.1 -5.2,9.7 -2.8,-0.4 -4.3,2.4 -4.3,8.1 0,4.7 -1.7,10.7 -3,10.7 -1.1,0 -10.8,-6.2 -14.6,-9.4 -2.8,-2.3 -3.3,-2.4 -4.4,-1.1 -1,1.2 -1.1,2.7 -0.3,6.2 1.3,5.7 1,6.8 -2.7,8.3 -4,1.7 -8.4,-0.9 -12.2,-7.1 -1.7,-2.7 -3.8,-4.9 -4.7,-4.9 -0.9,0 -5.4,2.5 -9.9,5.6 -8.2,5.4 -14.6,8.4 -18.3,8.4 -1.5,0 -1.7,-0.5 -1.3,-2.8 0.4,-1.9 0.1,-3.2 -1,-4.1 -0.9,-0.8 -1.6,-2.5 -1.6,-4 -0.1,-4.2 -2.2,-6.2 -5.9,-5.5 -1.9,0.4 -3.1,0.2 -3.1,-0.4 0,-0.6 1,-1.2 2.3,-1.4 2.5,-0.3 3.7,-4.6 1.5,-5.9 -0.9,-0.6 -0.4,-1.1 1.9,-1.9 1.7,-0.7 4.3,-2.7 5.7,-4.5 3.2,-4.2 5.9,-5.1 8.8,-3.1 1.2,0.9 2.8,1.6 3.5,1.6 2.2,0 5.1,-3.7 6.3,-7.9 0.7,-2.8 1.9,-4.5 3.9,-5.5 4.7,-2.5 5.4,-4 4.1,-8.2 -1.6,-4.8 -0.5,-5.7 5.6,-4.4 3.1,0.7 5.9,0.7 7.4,0.2 1.7,-0.6 3.1,-0.5 4.5,0.3 2.1,1.4 16.8,2.6 18.2,1.6 0.5,-0.3 1.5,-2.2 2.3,-4.1 0.7,-1.9 2.6,-4.8 4.2,-6.4 1.5,-1.5 2.8,-3.2 2.8,-3.6 0,-0.4 1.1,-1.2 2.5,-1.8 1.5,-0.7 3.3,-3 4.5,-5.7 2.1,-4.9 3.9,-5.2 5.8,-1 z"
     id="path1213"
     district="Wonosegoro" />
  <path
     d="m 289.8,97.375 c 4.3,1.4 8.8,2.5 10.1,2.5 1.3,0 3.1,1.2 4.4,3 1.4,1.9 3.7,3.3 6.5,4 2.3,0.7 5.9,2.5 7.9,4.1 2,1.6 4.2,2.9 4.7,2.9 0.6,0 2,0.9 3.2,2.1 1.6,1.6 3,2 6.7,1.7 l 4.7,-0.3 0.1,5.5 c 0,3.1 0.4,6.1 0.8,6.8 0.4,0.7 0.2,2.8 -0.5,4.7 -1.2,3.3 -1.6,3.5 -5.9,3.5 -2.5,0 -6.3,-0.5 -8.5,-1.1 -2.2,-0.6 -6.9,-1.2 -10.5,-1.4 -3.6,-0.1 -7.7,-0.6 -9.2,-1 -2.2,-0.6 -2.9,-0.2 -4.4,1.9 -1.4,2.2 -1.5,3.1 -0.5,5.2 1.7,3.9 1.4,4.9 -2.4,6.7 -2.6,1.2 -3.7,2.6 -4.4,5.4 -0.6,2.1 -1.7,4.7 -2.5,5.8 -1.2,1.7 -1.7,1.8 -4,0.7 -4.4,-2 -7,-1.4 -10.7,2.4 -1.8,2 -4.9,4.3 -6.8,5.1 -3.1,1.3 -3.3,1.7 -2.8,4.8 0.5,2.9 0.3,3.4 -1.6,3.7 -3.1,0.4 -3.5,4.3 -0.7,5.8 1.2,0.7 3,1 4.1,0.7 2.4,-0.7 4,1.3 3.2,4.2 -0.6,2.4 -10.9,8.1 -14.6,8.1 -2.5,0 -12.7,-10.5 -12.8,-13.3 -0.2,-4.2 0.3,-7.2 1.7,-9.9 0.8,-1.5 1.7,-4.8 2,-7.2 l 0.7,-4.4 5.1,-0.7 c 6.6,-1 8.9,-1.9 11.5,-4.6 2.5,-2.8 2.7,-5.1 0.4,-8.6 -1.7,-2.5 -1.7,-2.5 3.9,-7.7 9.1,-8.2 9.7,-11 4.1,-18.3 -2.5,-3.3 -3.9,-6.4 -4.5,-9.8 -0.4,-2.8 -1.5,-6.7 -2.4,-8.8 -1.9,-4.2 -1.8,-4.6 2.8,-5.7 6.2,-1.5 13.3,-1 21.1,1.5 z"
     id="path1211"
     district="Wonosamodro" />
  <path
     id="path1207"
     d="m 382.1,26.975 c 1.6,1.8 2.5,2 9.1,1.4 6.6,-0.7 7.6,-0.5 11.5,1.8 3.1,1.8 6.3,2.6 11.7,2.9 6.3,0.5 7.8,0.9 9.4,2.9 2.8,3.5 1.7,8.5 -3.5,15.6 -6,8.2 -13.3,23.1 -16,32.8 -1.4,4.9 -3.3,9.3 -5,11.3 -2.1,2.4 -2.8,4.3 -2.8,7.5 -0.1,9.2 -5.8,16 -12.7,15 -2.7,-0.4 -3.3,-0.2 -3.3,1.3 0,2.5 5.7,16.4 7.6,18.5 2.1,2.3 1.7,3.1 -1.3,2.7 -2.1,-0.2 -3.2,-1.2 -4.6,-4.1 -1.8,-3.9 -3.5,-4.5 -8.1,-2.8 -1.9,0.8 -3,0.6 -4.8,-0.8 -1.3,-1 -3.3,-2.2 -4.6,-2.6 -2.2,-0.6 -2.3,-1 -1.7,-6.8 0.6,-5.4 0.4,-6.5 -1.5,-9 -3.2,-4 -6.7,-3.7 -8.6,1 -1.5,3.6 -9.6,12.3 -11.4,12.3 -0.5,0 -1,-2.8 -1.2,-6.3 l -0.3,-6.2 -6,-0.5 c -4.7,-0.4 -5.9,-0.8 -5.6,-2 0.2,-0.8 0.8,-3.8 1.4,-6.5 0.5,-2.8 1.3,-5.7 1.8,-6.5 0.4,-0.8 2.2,-3.9 3.9,-6.7 4.3,-7.2 3.9,-11 -1.5,-13.7 -4,-2.2 -5.5,-5.1 -5.8,-12.1 -0.2,-2.5 0.4,-3.3 3.8,-5 10.3,-5.1 25.3,-14.1 28.3,-16.9 2,-1.9 3.7,-4.8 4.4,-7.5 0.9,-3.6 2.1,-5 7.1,-8.7 3.2,-2.4 6.5,-4.4 7.2,-4.4 0.6,0 2,0.9 3.1,2.1 z m 79.5,54.5 c 0.4,0.2 0.1,2.3 -0.7,4.6 -0.7,2.2 -1.4,5.3 -1.4,6.8 0,1.5 -0.3,4.1 -0.6,5.8 -0.6,3 -0.8,3.1 -2.7,1.7 -1.2,-0.8 -3.3,-1.5 -4.7,-1.5 -3.8,0 -4.8,-1.1 -5.1,-5.5 -0.2,-3.2 0.4,-5 3.2,-8.8 3.3,-4.7 3.5,-4.9 7.3,-4.2 2.2,0.3 4.3,0.8 4.7,1.1 z"
     district="Juwangi" />
  <path
     d="m 443.75,95.468752 -0.46875,-5.000002 -2.34375,0.156248 -3.4375,4.843755 -0.78125,3.75 -5.625,7.187497 -12.34375,7.03125 -16.71875,4.21875 -5,0.15625 -5.46875,3.125 -4.84375,0.3125 2.34375,7.8125 4.6875,9.6875 -0.3125,4.375 -4.6875,1.71875 -5.9375,-1.5625 -3.75,-3.59375 -1.5625,-2.65625 -5.9375,1.25 -4.84375,-2.1875 -3.75,3.90625 -3.75,4.53125 0.15625,5.15625 3.125,14.53125 -5.78125,9.0625 -4.375,1.40625 -2.1875,7.65625 -0.78125,5.46875 -0.46875,5.46875 L 350,202.5 l 2.8125,4.0625 5.625,-2.96875 3.4375,-6.25 5.625,-10 4.53125,-3.28125 7.1875,-1.09375 6.5625,-3.59375 8.28125,0.3125 6.09375,1.40625 4.375,2.65625 5.46875,1.09375 5,3.125 7.8125,-2.34375 1.40625,-2.65625 -4.375,-24.0625 -1.40625,-8.75 4.375,-7.96875 3.90625,-3.90625 4.0625,-5 5.15625,-2.65625 9.0625,3.4375 c 0,0 5.625,1.40625 6.40625,0.3125 0.78125,-1.09375 4.375,-3.75 4.375,-3.75 l 0.625,-3.125 c 0,0 -2.34375,-2.96875 -2.5,-3.75 -0.15625,-0.78125 1.40625,-8.28125 1.40625,-8.28125 l 1.25,-7.8125 -0.9375,-4.21875 -7.96875,-3.437503 c 0,0 -2.34375,0 -2.34375,-0.624997 0,-0.624997 -1.5625,-3.906248 -1.5625,-3.906248 z"
     id="path3199"
     district="Kemusu" />
</svg>
</div>
    <div id="legend" class="flex items-center flex-col lg:flex-row lg:space-x-6 mt-6 justify-center"></div>

    <div class="mt-10 text-gray-500 text-center">
      * Klik pada peta untuk melihat detail data.
    </div>
  </div>
  <div>
    <div id="district-label" class="capitalize text-xl font-semibold mb-10"></div>

    <div id="spinner" class="hidden items-center justify-center h-96 bg-gray-50 rounded-lg">
      <svg role="status" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-green-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
      </svg>
      <div class="text-gray-500 ml-2.5">Tabel sedang dimuat...</div>
    </div>

    <div id="table-wrapper">
      @foreach ($dataByDistrict as $district => $data)
        <table table-district="{{strtolower($district)}}" class="!pt-6 !mb-4 hidden whitespace-nowrap items-center w-full border-collapse">
          <thead>
            <tr>
              <th class="px-6 align-middle border border-solid py-3 text-sm capitalize border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                Desa
              </th>
              <th class="px-6 align-middle border border-solid py-3 text-sm capitalize border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                Rasio Lahan
              </th>
              <th class="px-6 align-middle border border-solid py-3 text-sm capitalize border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                Rasio Sarana
              </th>
              <th class="px-6 align-middle border border-solid py-3 text-sm capitalize border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                Rasio PDDK Tidak Sejahtera
              </th>
              <th class="px-6 align-middle border border-solid py-3 text-sm capitalize border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                Akses Jalan
              </th>
              <th class="px-6 align-middle border border-solid py-3 text-sm capitalize border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                Rasio Tanpa Air Bersih
              </th>
              <th class="px-6 align-middle border border-solid py-3 text-sm capitalize border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                Rasio PDDK Per Tenkes Per Density
              </th>
              <th class="px-6 align-middle border border-solid py-3 text-sm capitalize border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                P Lahan
              </th>
              <th class="px-6 align-middle border border-solid py-3 text-sm capitalize border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                P Sarana
              </th>
              <th class="px-6 align-middle border border-solid py-3 text-sm capitalize border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                P PDDK Tidak Sejahtera
              </th>
              <th class="px-6 align-middle border border-solid py-3 text-sm capitalize border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                P Jalan
              </th>
              <th class="px-6 align-middle border border-solid py-3 text-sm capitalize border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                P Tanpa Air Bersih
              </th>
              <th class="px-6 align-middle border border-solid py-3 text-sm capitalize border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                P PDDK Per Tenkes Per Density
              </th>
              <th data-priority="1" class="px-6 align-middle border border-solid py-3 text-sm capitalize border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                Indeks
              </th>
              <th data-priority="2" class="px-6 align-middle border border-solid py-3 text-sm capitalize border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                Level
              </th>
            </tr>
          </thead>
        
          <tbody>
            @foreach ($data as $row)
              <tr>
                <td class="border-t-0 !py-4 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap">
                  {{ $row->subdistrict }}
                </td>
                <td class="border-t-0 !py-4 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap">
                  {{ $row->rasio_lahan }}
                </td>
                <td class="border-t-0 !py-4 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap">
                  {{ $row->rasio_sarana }}
                </td>
                <td class="border-t-0 !py-4 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap">
                  {{ $row->rasio_pddk_tidak_sejahtera }}
                </td>
                <td class="border-t-0 !py-4 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap">
                  {{ $row->akses_jalan }}
                </td>
                <td class="border-t-0 !py-4 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap">
                  {{ $row->rasio_tanpa_air_bersih }}
                </td>
                <td class="border-t-0 !py-4 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap">
                  {{ $row->rasio_pddk_per_tenkes_per_density }}
                </td>
                <td class="border-t-0 !py-4 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap">
                  {{ $row->p_lahan }}
                </td>
                <td class="border-t-0 !py-4 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap">
                  {{ $row->p_sarana }}
                </td>
                <td class="border-t-0 !py-4 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap">
                  {{ $row->p_pddk_tidak_sejahtera }}
                </td>
                <td class="border-t-0 !py-4 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap">
                  {{ $row->p_jalan }}
                </td>
                <td class="border-t-0 !py-4 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap">
                  {{ $row->p_tanpa_air_bersih }}
                </td>
                <td class="border-t-0 !py-4 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap">
                  {{ $row->p_pddk_per_tenkes_per_density }}
                </td>
                <td class="border-t-0 !py-4 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap">
                  {{ $row->indeks }}
                </td>
                <td
                  class="border-t-0 !py-4 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap"
                  style="background-color: {{$colors[$row->prio_komp - 1]}}; color: {{$colors[$row->prio_komp - 1]}}"
                >
                  <div class="bg-white rounded-md py-1 px-2 inline-block font-medium">
                    {{ $row->prio_komp }}
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @endforeach
    </div>
  </div>
</div>
@endsection

@push('head')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.12.1/r-2.3.0/datatables.min.css"/>
@endpush

@push('script')
<script>
  const tableInits = [];
  const spinner = document.querySelector('#spinner');
  const legend = document.querySelector('#legend');
  const map = document.querySelector('#peta');

  const ratings = @json($ratings);
  const colors = @json($colors);

  const renderColors = () => {
      const districts = map.querySelectorAll('path');
      const districtLabel = document.querySelector('#district-label');
    
      districts.forEach((element) => {
        const district = element.getAttribute('district').toLowerCase();
        const districtRating = ratings.filter((rating) => rating.district.toLowerCase() === district)?.[0]?.rating;
        element.style.fill = colors[parseInt(districtRating) - 1];
    
        const tables = document.querySelectorAll('[table-district]');
        const table = document.querySelector(`[table-district="${district}"]`);
    
        element.addEventListener('click', () => {
          districtLabel.innerHTML = `Menampilkan data: <span class="text-green-500">${district}</span>`;
    
          tables.forEach((table) => {
            const tableWrapper = table.closest('.dataTables_wrapper');
            table.classList.add('hidden');
            if (tableWrapper) {
              tableWrapper.classList.add('hidden');
            }
          });
    
          const tableWrapper = table.closest('.dataTables_wrapper');
          table.classList.remove('hidden');
          if (tableWrapper) {
            tableWrapper.classList.remove('hidden');
          }
    
          if (!tableInits.includes(district)) {
            spinner.classList.add('flex');
            new DataTable(table, {
              responsive: true,
              lengthMenu: [20, 50],
              fnInitComplete: function() {
                tableInits.push(district);
                spinner.classList.add('hidden');
              }
            });
            }
        });
      });
  }

  colors.forEach((color, index) => {
    const wrapper = document.createElement('div');
    const indicator = document.createElement('div');
    const label = document.createElement('span');

    wrapper.classList.add('flex', 'items-center', 'whitespace-nowrap');
    indicator.classList.add('py-2', 'px-4', 'mr-3');
    indicator.style.backgroundColor = color;
    label.textContent = `Level ${index + 1}`;

    wrapper.appendChild(indicator);
    wrapper.appendChild(label);

    legend.appendChild(wrapper);
  });

  (function() {
    renderColors();
  })();
</script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.12.1/r-2.3.0/datatables.min.js"></script>
@endpush