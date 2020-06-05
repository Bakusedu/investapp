@extends('layouts.forum.header')
@section('head')
    <style>
.timeline {
  position: relative;
  width: 660px;
  margin-top: 20px;
  padding: 1em 0;
  list-style-type: none;
}

.timeline:before {
  position: absolute;
  left: 5%;
  top: 0;
  content: ' ';
  display: block;
  width: 6px;
  height: 100%;
  margin-left: -3px;
  background: rgb(80,80,80);
  background: -moz-linear-gradient(top, rgba(80,80,80,0) 0%, rgb(80,80,80) 8%, rgb(80,80,80) 92%, rgba(80,80,80,0) 100%);
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(30,87,153,1)), color-stop(100%,rgba(125,185,232,1)));
  background: -webkit-linear-gradient(top, rgba(80,80,80,0) 0%, rgb(80,80,80) 8%, rgb(80,80,80) 92%, rgba(80,80,80,0) 100%);
  background: -o-linear-gradient(top, rgba(80,80,80,0) 0%, rgb(80,80,80) 8%, rgb(80,80,80) 92%, rgba(80,80,80,0) 100%);
  background: -ms-linear-gradient(top, rgba(80,80,80,0) 0%, rgb(80,80,80) 8%, rgb(80,80,80) 92%, rgba(80,80,80,0) 100%);
  background: linear-gradient(to bottom, rgba(80,80,80,0) 0%, rgb(80,80,80) 8%, rgb(80,80,80) 92%, rgba(80,80,80,0) 100%);

  z-index: 5;
}

.timeline li {
  padding: 1em 0;
}

.timeline li:after {
  content: "";
  display: block;
  height: 0;
  clear: both;
  visibility: hidden;
}

.direction-l {
  position: relative;
  width: 300px;
  float: left;
  text-align: right;
}

.direction-r {
  position: relative;
  width: 100%;
  left: 65px;
}

.flag-wrapper {
  position: relative;
  display: inline-block;

  text-align: center;
}

.flag {
  position: relative;
  display: inline;
  background: rgb(248,248,248);
  padding: 6px 10px;
  border-radius: 5px;

  font-weight: 600;
  text-align: left;
}

.direction-l .flag {
  -webkit-box-shadow: -1px 1px 1px rgba(0,0,0,0.15), 0 0 1px rgba(0,0,0,0.15);
  -moz-box-shadow: -1px 1px 1px rgba(0,0,0,0.15), 0 0 1px rgba(0,0,0,0.15);
  box-shadow: -1px 1px 1px rgba(0,0,0,0.15), 0 0 1px rgba(0,0,0,0.15);
}

.direction-r .flag {
  -webkit-box-shadow: 1px 1px 1px rgba(0,0,0,0.15), 0 0 1px rgba(0,0,0,0.15);
  -moz-box-shadow: 1px 1px 1px rgba(0,0,0,0.15), 0 0 1px rgba(0,0,0,0.15);
  box-shadow: 1px 1px 1px rgba(0,0,0,0.15), 0 0 1px rgba(0,0,0,0.15);
}

.direction-l .flag:before,
.direction-r .flag:before {
  position: absolute;
  top: 50%;
  right: -40px;
  content: ' ';
  display: block;
  width: 12px;
  height: 12px;
  margin-top: -10px;
  background: #fff;
  border-radius: 10px;
  border: 4px solid rgb(255,80,80);
  z-index: 10;
}

.direction-r .flag:before {
  left: -40px;
}

.direction-l .flag:after {
  content: "";
  position: absolute;
  left: 100%;
  top: 50%;
  height: 0;
  width: 0;
  margin-top: -8px;
  border: solid transparent;
  border-left-color: rgb(248,248,248);
  border-width: 8px;
  pointer-events: none;
}

.direction-r .flag:after {
  content: "";
  position: absolute;
  right: 100%;
  top: 50%;
  height: 0;
  width: 0;
  margin-top: -8px;
  border: solid transparent;
  border-right-color: rgb(248,248,248);
  border-width: 8px;
  pointer-events: none;
}

.time-wrapper {
  display: inline;

  line-height: 1em;
  font-size: 0.66666em;
  color: rgb(250,80,80);
  vertical-align: middle;
}

.direction-l .time-wrapper {
  float: left;
}

.direction-r .time-wrapper {
  float: right;
}

.time {
  display: inline-block;
  padding: 4px 6px;
  background: rgb(248,248,248);
}

.desc {
  margin: 1em 0.75em 0 0;

  font-size: 0.77777em;
  font-style: italic;
  line-height: 1.5em;
}

.direction-r .desc {
  margin: 1em 0 0 0.75em;
}

/* ================ Timeline Media Queries ================ */

@media screen and (max-width: 660px) {

.timeline {
 	width: 100%;
    padding: 4em 0 1em 0;
    margin: 0 auto;
}
.timeline::before{
    left: 50%;
}
.timeline li {
	padding: 2em 0;
}

.direction-r {
	float: none;
    width: 100%;
    text-align: center;
    left: 0px;
}

.flag-wrapper {
	text-align: center;
}

.flag {
	background: rgb(255,255,255);
	z-index: 15;
}

.direction-l .flag:before,
.direction-r .flag:before {
  position: absolute;
  top: -30px;
	left: 50%;
	content: ' ';
	display: block;
	width: 200px;
	height: 100px;
	margin-left: -9px;
	background: #fff;
	border-radius: 10px;
	border: 4px solid rgb(255,80,80);
	z-index: 10;
}

.direction-l .flag:after,
.direction-r .flag:after {
	content: "";
	position: absolute;
	left: 50%;
	top: -8px;
	height: 0;
	width: 0;
	margin-left: -8px;
	border: solid transparent;
	border-bottom-color: rgb(255,255,255);
	border-width: 8px;
	pointer-events: none;
}

.time-wrapper {
	display: block;
	position: relative;
	margin: 4px 0 0 0;
	z-index: 14;
}

.direction-l .time-wrapper {
	float: none;
}

.direction-r .time-wrapper {
	float: none;
}

.desc {
	position: relative;
	margin: 1em 0 0 0;
	padding: 1em;
	background: rgb(245,245,245);
	-webkit-box-shadow: 0 0 1px rgba(0,0,0,0.20);
	-moz-box-shadow: 0 0 1px rgba(0,0,0,0.20);
	box-shadow: 0 0 1px rgba(0,0,0,0.20);

  z-index: 15;
}

.direction-l .desc,
.direction-r .desc {
	position: relative;
	margin: 1em 1em 0 1em;
	padding: 1em;

  z-index: 15;
}

}

@media screen and (min-width: 400px ?? max-width: 660px) {

.direction-l .desc,
.direction-r .desc {
	margin: 1em 4em 0 4em;
}

}
    </style>
@endsection
@section('content')
<div class="bg-gray-300 flex py-12 px-3 h-full h-screen">
    <div x-data="{ tab: 'forums' }" class="w-screen">
      <div
        class="flex"
      >
        <div class="flex -mx-px w-5/6">
            <button
            x-on:click="tab = 'forums'"
            x-bind:class="{ 'bg-white border-white': tab === 'forums' }"
            class="bg-transparent hover:bg-gray-200 text-gray-700 text-sm md:text-base font-semibold rounded-t focus:outline-none mx-px py-px md:py-2 px-3 md:px-4"
            type="button"
          >
          Forums
          </button>
          <button
            x-on:click="tab = 'activity'"
            x-bind:class="{ 'bg-white border-white': tab === 'activity' }"
            class="bg-transparent hover:bg-gray-200 text-gray-700 font-semibold rounded-t focus:outline-none mx-px py-2 px-4"
            type="button"
          >
            Activity
          </button>
        <button
          x-on:click="tab = 'guidlines'"
          x-bind:class="{ 'bg-white border-white': tab === 'guidlines' }"
          class="bg-transparent hover:bg-gray-200 text-gray-700 text-sm md:text-base font-semibold rounded-t focus:outline-none mx-px py-px md:py-2 px-3 md:px-4"
          type="button"
        >
          Guidlines
        </button>
        </div>
        <div x-data="{ open: false }" class="flex-1 w-1/6 ">
            <div
            class="bg-transparent text-white text-sm md:text-base text-center font-semibold py-3 rounded-t bg-yellow-600"
            x-on:click="open = true"
            type="button"
            >
            Start a new topic
            </div>
            <!--Overlay-->
            <div class="overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="open" x-show="open" @click.away="open = false" :class="{ 'absolute inset-0 z-10 flex items-center justify-center': open }">
                <!--Dialog-->
                <div class="bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg py-4 text-left px-6" x-show="open" @click.away="open = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">

                    <!--Title-->
                    <div class="flex justify-between items-center pb-3">
                        <p class="text-2xl font-bold">Simple Modal!</p>
                        <div class="cursor-pointer z-50" @click="open = false">
                            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- content -->
                    <p>Modal content can go here</p>
                    <p>...</p>
                    <p>...</p>
                    <p>...</p>
                    <p>...</p>

                </div>
                <!--/Dialog -->
            </div><!-- /Overlay -->
      </div>
      </div>
      <ul class="bg-white text-sm rounded-b p-4">
        <li x-show="tab === 'forums'">
               <div class="p-8">
                   <h2 class="top-0 text-lg font-bold">Business Forum</h2>
                   <p class="top-0 text-gray-500">Issues facein fj sdf</p>
                  <div class="mt-5 p-8 rounded-lg border-gray-400 border">
                        <div class="flex bg-orange-100">
                            <div class="flex-1 flex justify-start text-gray-700 w-11/12 py-2 m-2">
                                <div class="flex-1 w-1/12">
                                  <span class="rounded-full bg-gray-500 text-white p-2" style="font-size: 30px"><i class="fa fa-comments text-4xl"></i></span>
                                </div>
                                <div class="flex-none w-10/12 px-3">
                                  <h2 class="text-xl font-bold">Topic General Topics</h2>
                                  <p class="text-gray-500">By Some decsd ksd j sd </p>
                                </div>
                              </div>
                              <div class="flex-none text-gray-800 text-center w-2/12 px-4 py-2 m-2">
                                <h2 class="text-lg font-bold">12 replies</h2>
                                <p class="text-gray-500">23 views</p>
                              </div>
                        </div>
                  </div>
            </div>
        </li>
        <li x-show="tab === 'activity'">
            <ul class="timeline">

                <!-- Item 1 -->
                <li>
                    <div class="direction-r">
                        <div class="flag-wrapper">
                            <span class="flag">very long hsa hjds  sdh</span>
                            <span class="time-wrapper"><span class="time">2008 - 2011</span></span>
                        </div>
                        <div class="desc">
                            <h1>Topic</h1>
                            <p>My current employment. Way better than the position before! My current employment. Way better than the position before! My current employment. Way better than the position before! My current employment. Way better than the position before!</p>
                        </div>
                    </div>
                </li>
                <!-- Item 3 -->
                <li>
                    <div class="direction-r">
                        <div class="flag-wrapper">
                            <span class="flag">Harvard University</span>
                            <span class="time-wrapper"><span class="time">2008 - 2011</span></span>
                        </div>
                        <div class="desc">A description of all the lectures and courses I have taken and my final degree?</div>
                    </div>
                </li>

            </ul>

        </li>
        <li x-show="tab === 'guidlines'" class="p-8">
            <ul class="list-outside list-disc bg-gray-200 ...">
                <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit</li>
            </ul>
        </li>
      </ul>
    </div>
  </div>
@endsection
