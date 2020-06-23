<template>
  <div class="flex-none static flex xs:w-full flex-col xs:flex-row items-center rounded-md w-2/12 p-3 xs:m-0 m-3 bg-white">
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
                    <router-link :to="{ name: 'manager', params: { myprogrammes: myprogrammes }}">
                    <button id="users" class="bg-gray-300 text-gray-700 font-semibold py-2 xs:py-1 xs:p-4 xs:text-sm px-8 rounded inline-flex items-center">
                        <span class="mr-1">Events Manager</span>
                    </button>
                    </router-link>
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
</template>

<script>
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
                    if (page_url == '/api/programmes/all') {
                    vm.$router.push({name: 'dashboard', params: {programmes: response.data.data}})
                    } else if(page_url == '/api/programmes/mine'){
                        vm.$router.push({name: 'hosted', params: {programmes: response.data.data}})
                    } else if (page_url == '/api/programmes/attended'){
                    vm.$router.push({name: 'attended', params: {programmes: response.data.data}})
                    }
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
        },
        mounted(){
            //Check if the user is Authenticated
            this.isLoggedIn = window.Laravel.isLoggedin
            this.isLoggedIn ? this.user = window.Laravel.user : this.user = null
            //  let vm  = this
            // EventBus.$on('events', function (payLoad) {
            //         vm.edit = payLoad.edit

            // });
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

</style>
