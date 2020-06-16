<template>
    <div class="bg-gray-300 flex flex-row xs:flex-col pt-20 xs:px-0 px-6">
                    <notifications group="foo" />
    <div class="flex-none flex xs:w-full flex-col xs:flex-row items-center rounded-md w-2/12 p-3 xs:m-0 m-3 bg-white">
        <div class="h-24 w-24 xs:hidden rounded-full mt-8 mb-5">
         <img :src="'/files/images?filename=' + user.avatar" class="object-fit rounded-full h-24 w-24 mt-8 mb-5" alt="" srcset="">
        </div>
        <div class="xs:flex-1 p-4 xs:hidden"><h3 class="font-bold"><span>{{user.first_name}}</span> <span>{{user.last_name}}</span></h3>
            <h3>{{user.email}}</h3></div>
        <div class="flex-col flex xs:flex-row flex-wrap items-center justify-between">
            <div class="p-4">
                <a :href="'/forum/home'"
                    class="bg-gray-300 text-gray-700 font-semibold py-2 xs:py-1 xs:px-10 px-16 rounded inline-flex items-center"
                    >
                    <span class="mr-1">Forum</span>
                </a>
            </div>
            <div class="p-4">
                <div class="dropdown inline-block relative">
                  <button id="programmes" v-on:click="fetchStories('/api/programmes/all')" class="bg-gray-300 text-gray-700 font-semibold py-2 xs:py-1 xs:p-4 xs:text-sm px-8 rounded inline-flex items-center">
                    <span class="mr-1">Programmes</span>
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/> </svg>
                  </button>
                  <ul class="dropdown-menu absolute hidden text-gray-700 pt-1">
                    <li v-on:click="fetchStories('/api/programmes/mine')" class=""><button class="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-10 block whitespace-no-wrap">Hosted</button></li>
                    <li v-on:click="fetchStories('/api/programmes/attended')" class=""><button class="bg-gray-200 hover:bg-gray-400 py-2 px-8 block whitespace-no-wrap" >Attended</button></li>
                  </ul>
                </div>
            </div>

            <div v-if="hasProgram" class="p-4">
                <div class="inline-block">
                  <button @click="manager=true" id="users" class="bg-gray-300 text-gray-700 font-semibold py-2 xs:py-1 xs:p-4 xs:text-sm px-8 rounded inline-flex items-center">
                    <span class="mr-1">Events Manager</span>
                   </button>
                </div>
            </div>
            <div class="p-4">
            <div class="inline-block">

            <a href="/logout">
                    <li class="bg-gray-200 hover:bg-gray-400 rounded py-2 px-8 block xs:py-1 xs:p-4 xs:px-10 xs:text-sm whitespace-no-wrap">
                        Logout
                    </li>
            </a>
            </div>
            </div>
        </div>
    </div>
    <transition name="flip-list" mode="out-in">
    <div key="overview" v-if="details==true && manager == false"  class="flex-1 z-10 xs:m-0 xs:mt-5 m-3 p-6 flex xs:flex-col rounded-lg bg-white">
        <div v-if="isloading" class="flex w-full justify-center text-center">
             <span class="text-xl">Loading...</span>
        </div>
        <div v-else class="w-full flex xs:flex-col rounded-lg bg-white">
        <div class="relative w-3/12 hover:w-2/12 rounded-md flex xs:flex-none xs:w-full items-center flex-col bg-gray-500" :style="{backgroundImage:`url('/files/images?filename=${programme.programme.featured}')`, backgroundSize:'cover', backgroundRepeat:'no-repeat', backgroundPosition:'center'}">
            <div class="absolute h-full w-full " style="background: rgba(0,0,0, 0.5)"></div>
            <p class="font-extrabold z-10 bg-orange-400 pb-4 w-full pt-2 text-lg text-center">Event</p>
            <p class="text-center bg-white z-10 rounded w-full text-black font-bold">{{programme.programme.title}}</p>
            <div class="flex flex-col w-full z-10 items-center justify-center h-64 flex-wrap xs:flex-no-wrap">
            <p v-on:click="viewFacilitators = true" class="text-lg w-full text-center"><span class="hover:shadow-2xl text-sm hover:bg-indigo-600 cursor-pointer shadow-lg p-2 px-3 rounded-md bg-blue-700 border-purple-900 border text-white">Facilitators ({{programme.programme.speakers.length + 1}}) <i class="fa fa-eye"></i></span> </p>
            <a :href="'/programme/calendar/'+programme.programme.id" class="text-lg  text-center"><span class="hover:shadow-2xl text-sm hover:bg-yellow-700 shadow-lg p-2 px-3 rounded-md bg-yellow-700 text-white border-yellow-700 border"> View Calendar <i class="fa fa-calendar-alt"></i></span> </a>
            <div v-on:click="joinProgram(programme.programme.id)" v-if="!programme.requested&&programme.confirmed==false" class="text-lg z-10 flex justify-center text-center">
            <div>
                <p v-if="requesting == 'sending'" class=" p-1 px-3 rounded-md bg-yellow-700 text-white">Sending request...</p><p class="hover:shadow-2xl text-sm hover:bg-yellow-700 cursor-pointer shadow-lg p-1 px-3 rounded-md bg-yellow-700 text-white" v-else-if="requesting=='sent'">Request Sent</p><p class="hover:shadow-2xl text-sm hover:bg-yellow-700 cursor-pointer shadow-lg p-1 px-3 rounded-md bg-yellow-700 text-white" v-else>Join Programme<p></p></div> </div>
                <a href="#" v-else-if="programme.requested&&programme.confirmed==true" class="text-lg text-center"><span class="hover:shadow-2xl text-sm hover:bg-yellow-700 shadow-lg p-1 px-3 rounded-md bg-green-700 text-white"><i class="fa fa-info"></i> You are attending</span> </a>
                <a href="#" v-else-if="programme.requested" class="text-lg w-full text-center"> <span class="hover:shadow-2xl text-sm hover:bg-green-600 shadow-lg p-1 px-3 rounded-md bg-green-700 text-white">Awaiting Confirmation</span> </a>
            </div>
            <div class="flex z-10 justify-center items-center w-full">
                <span class="flex-1 text-lg text-center  bg-white"><span class="hover:shadow-2xl text-sm shadow-lg p-1 rounded-md text-blue-700"> <i class="fab fa fa-user-plus"></i> {{programme.programme.users.length}} </span></span>
                <span class="flex-1 text-lg text-center  bg-white"><span class="hover:shadow-2xl text-sm  shadow-lg p-1  rounded-md text-blue-700"><i class="fab fa-facebook-square"></i></span> </span>
                <span class="flex-1 text-lg text-center  bg-white"><span class="hover:shadow-2xl text-sm  shadow-lg p-1  rounded-md text-blue-500"><i class="fab fa-twitter-square"></i></span> </span>
            </div>
        </div>
         <div class="w-9/12 xs:w-full flex-col h-auto text-gray-800 bg-white">
            <div class="p-2 text-center">
             <p class="px-16 text-lg font-extrabold">{{programme.programme.title}}</p>
                <h1 class="font-bold text-lg">Programme Overview</h1>
            </div>
            <p class="p-6 text-justify text-gray-700"><span><i style="font-size: 10" class="fa fa-info"></i></span> {{programme.programme.overview}}</p>
            <p class=" px-6 font-bold text-lg">Key Features</p>
            <hr class="w-full bg-gray-300">
            <ul class="p-2 pl-8 text-base list-disc text-gray-700 text-justify">
                <li v-for="(item, index) in programme.keyFeatures" :key="index">{{item}}</li>
            </ul>
            <p class=" px-6 text-center font-bold text-xl"><span><i class="fa fa-calendar-check"></i></span> Programme Events</p>
            <table v-if="programme.events != null"  class="p-6 table-fixed w-full ">
                <thead>
                    <th class="border py-2">Title</th>
                    <th class="border py-2 ">Start Date</th>
                    <th class="border py-2 ">Due Date</th>
                    <th class="border py-2" v-if="programme.confirmed">Feedback</th>
                </thead>
                <tbody>
                <tr v-for="(item, index) in programme.events" :key="index">
                    <td class="text-black py-2 px-6">
                    {{item.title}}
                    </td>
                    <td>
                     {{ item.start_date | moment("MMMM Do YYYY") }}
                    </td>
                    <td>
                     {{item.end_date | moment("MMMM Do YYYY") }}
                    </td>
                    <td v-if="programme.confirmed">
                       <span v-if="item.use_feedback" class="px-3 cursor-pointer bg-gray-700 text-white rounded">
                           Submit Feedback
                       </span> <span v-else>Not Required</span>
                    </td>
                </tr>
            </tbody>
        </table>
        <p v-else>No Events Scheduled</p>
        </div>
         <facilitator-component v-bind:view="viewFacilitators" v-bind:facilitators="programme.programme.speakers" v-bind:creator="programme.programme.creator" @close="viewFacilitators=!viewFacilitators"></facilitator-component>
        <a href="#" v-on:click="details=false" class="absolute z-50 flex-1 float-left right-0 justify-end"><span class="px-4 rounded-full shadow-xl bg-white py-2 font-extrabold" style="font-size: 30px">X</span></a>
    </div>
    </div>
    <div v-if="details == false && manager == false" key="programmeTiles" class="relative flex-1 xs:m-0 xs:mt-5 m-3 flex-col flex xs:flex-col rounded-lg bg-white">
            <div class="flex-1 text-lg font-bold"><span><i class="fa fa-calendar-alt"></i> Programmes</span>
            </div>
                <!-- button -->
                <div class="absolute right-0 mt-5 pr-10 xs:pr-2">
                    <a v-on:click="create = true" href="#"
                        class="bg-green-600 xs:text-xs shadow-lg text-white font-semibold py-2 xs:py-1 text-sm xs:px-10 px-16 rounded inline-flex items-center"
                        >
                        <span class="mr-1">Create Programme</span>
                    </a>
                </div>
                <transition-group name="slide-fade" class="flex flex-wrap xs:flex-col justify-evenly items-center">
                <div v-for="item in programmes" :key="item.id" class="flex flex-col xs:w-full px-6 py-2 w-1/3">
                    <div v-if="item.type =='free'" class="absolute border bg-green-600 h-10 w-10 justify-center" style="border-bottom-right-radius: 50%;">
                        <div class="flex items-center text-white pt-2 text-center justify-center">
                          {{item.type}}
                        </div>
                    </div>
                    <div v-else class="absolute border h-10 w-10 bg-orange-600 justify-center" style="border-bottom-right-radius: 50%;">
                        <div class="flex items-center pt-2 text-white text-center justify-center">
                           {{item.type}}
                        </div>
                    </div>

                    <div v-on:click="fetchDetails(item.id)" class="flex-1 h-20">
                        <img :src="'/files/images?filename=' + item.featured" class="object-cover h-40 w-full" alt="" srcset="">
                    </div>
                    <div class="h-20 max-h-full pb-6 mb-8 w-full" style="text-overflow: ellipsis;">
                        <p v-on:click="fetchDetails(item.id)" class="font-bold cursor-pointer">{{item.title}}</p>
                        <p class="text-sm">{{item.overview| truncate(90,'...')}}</p>
                        <div class="flex justify-between">
                        <span class="text-blue-700 shadow-xs cursor-pointer font-medium" v-on:click="fetchDetails(item.id)">Show more ></span>
                        <span v-if="item.createdBy === user.id" class="cursor-pointer hover:bg-blue-800 hover:text-white text-black px-6 rounded shadow-sm bg-gray-300" v-on:click="editEvents(item.id)"> Edit</span>
                        </div>
                    </div>

                </div>
              </transition-group>
                    <edit-component key="edit" class="z-50 h-full top-0 absolute" style="background: rgba(0,0,0,0.5)" v-bind:edit="edit" v-bind:programme="programme" @close="edit=!edit"></edit-component>
            <div class="pagination">
            <button class="text-gray-700 text-center bg-gray-400 px-4 py-2 m-2 disabled" @click="fetchStories(pagination.prev_page_url)"
                    :disabled="!pagination.prev_page_url">
                Previous
            </button>
            <span>Page {{pagination.current_page}} of {{pagination.last_page}}</span>
            <button class="text-gray-700 text-center bg-gray-400 px-4 py-2 m-2" @click="fetchStories(pagination.next_page_url)"
                    :disabled="!pagination.next_page_url">Next
            </button>
            </div>
    </div>

    <div v-if="manager == true" key="manager" class="flex-1 xs:m-0 xs:mt-5 m-3 flex-col flex xs:flex-col rounded-lg bg-white">
            <manager class="w-full p-2 flex xs:flex-col rounded-lg bg-white" v-bind:myprogrammes="myprogrammes"></manager>
    </div>
    </transition>
    <post-component v-bind:create="create" @close="create=!create"></post-component>

</div>
</template>
<script>
const MAX_SIZE = 1000000;
const MAX_WIDTH = 720;
const MAX_HEIGHT = 720;
import EventBus from '../event-bus';
    export default {
          data(){
            return {
                image:{
                size:'',
                height:'',
                width:''
                },
                myprogrammes: [],
                 imageError:'',
                imageLoaded:false,
                isLoggedIn : true,
                user: '',
                programmes: [],
                hasProgram: false,
                show: true,
                pagination: {},
                details: false,
                isloading: true,
                programme: '',
                create: '',
                viewFacilitators: '',
                requesting: 'notsent',
                edit: false,
                editId: null,
                manager: false
            }
        },
        methods: {
            fetchStories: function (page_url) {
                let vm = this;
                this.show=false;
                this.manager=false;
                page_url = page_url || '/api/programmes/all'
                axios
                .get(page_url)
                    .then(function (response) {
                        vm.makePagination(response.data)
                        vm.programmes = response.data.data

                 });
            },

            makePagination: function(data){
                    let pagination = {
                        current_page: data.current_page,
                        last_page: data.last_page,
                        next_page_url: data.next_page_url,
                        prev_page_url: data.prev_page_url
                    }
                    this.pagination= pagination
                },
            fetchDetails: function(id){
                this.details = true;
                this.manager =false;
                axios.get('/api/program/details', {
                    params: {
                        id: id
                    }
                }).then((response)=> {
                    this.programme = response.data
                    this.isloading = false;
                });
            },
            editEvents: function(id){
               axios.get('/api/program/details', {
                    params: {
                        id: id
                    }
                }).then((response)=> {
                this.programme = response.data
                this.edit = true
                });
            },
            selectedFile() {
            this.imageError = '';

            let file = this.$refs.myFile.files[0];

            if(!file || file.type.indexOf('image/') !== 0) return;
            this.image.size = file.size;
            if(this.image.size > MAX_SIZE) {
                this.imageError = `The image size (${this.image.size}) is too much (max is ${MAX_SIZE}).`;
                return;
            }

            let reader = new FileReader();

            reader.readAsDataURL(file);
            reader.onload = evt => {
                let img = new Image();
                img.onload = () => {
                this.image.width = img.width;
                this.image.height = img.height;

                if(this.image.width > MAX_WIDTH) {
                    this.imageError = `The image width (${this.image.width}) is too much (max is ${MAX_WIDTH}).`;
                    return;
                }
                if(this.image.height > MAX_HEIGHT) {
                    this.imageError = `The image height (${this.image.height}) is too much (max is ${MAX_HEIGHT}).`;
                    return;
                }


                }
                img.src = evt.target.result;
            }

            reader.onerror = evt => {
                console.error(evt);
            }

            },

        joinProgram(id){
            this.requesting = 'sending';
            axios.get('/api/join', {
                params: {
                    id: id
                }
            }).then((response)=> {
                 this.$notify({
                group: 'foo',
                title: 'Success',
                text: 'Your request is awaiting approval',
                duration: 10000,
                });
                this.requesting = 'sent';
            });
        },

        },
        mounted(){
            //Check if the user is Authenticated
            this.isLoggedIn = window.Laravel.isLoggedin
            this.isLoggedIn ? this.user = window.Laravel.user : this.user = null
            this.fetchStories()
             let vm  = this
            EventBus.$on('events', function (payLoad) {
                    vm.edit = payLoad.edit

            });
        },

         beforeMount() {
            hasProgram: {
               let vm = this
            axios.get('/api/programmes/mine').then((response)=>{
                this.myprogrammes = response.data.data
                response.data.data.length > 0 ? vm.hasProgram = true : vm.hasProgram = false;

            })
            }
        }
}
</script>

<style>
    .dropdown:hover .dropdown-menu {
  display: block;
}
.flip-list-move{
transition: transform 30s;
}
.slide-fade-enter-active{
    transition: all .3s ease;
}

.slide-fade-leave-active{
    transition: all .3s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}

.slide-fade-enter, .slide-fade-leave-to {
    transform: translateX(100px);
    opacity: 0;
}

</style>
