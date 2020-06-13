<template>
    <div class="flex-col relative shadow-2xl overflow-x-auto">
        <div class="text-lg font-bold"><span><i class="fa fa-calendar-alt"></i>Programme Manager</span>
        </div>
    <div class="table w-full">
        <div class="table-header-group border">
            <div class="table-row table-caption font-bold">
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm">Title</div>
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm">Date</div>
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm">No. of Events</div>
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm">No. of <br/> Participants</div>
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm">Invited <br/>Speakers</div>
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm">Actions</div>
            </div>
        </div>
        <div class="table-row-group">
            <div class="table-row" v-for="(item,index) in myprogrammes" :key="index">
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm">{{item.title}}</div>
                <div class="table-cell bg-gray-200 text-gray-700 px-4 py-2 text-sm">{{ item.startdate | moment("MMMM Do YYYY") }} - {{ item.enddate | moment( "MMMM Do YYYY") }}</div>
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm"><span v-on:click="loadEvents(item.events)" class="bg-green-700 hover:shadow-lg w-full rounded px-3 py-1 text-white">{{item.events.length}} <i class="fa fa-eye"></i> </span> </div>
                <div class="table-cell bg-gray-200 text-gray-700 px-4 py-2 text-sm"><span v-on:click="loadUsers(item.users)" class="bg-yellow-700 hover:shadow-lg w-full rounded px-3 py-1 text-white">{{item.users.length}}<i class="fa fa-eye"></i></span></div>
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm"><span v-on:click="loadSpeakers(item.speakers)" class="bg-purple-700 hover:shadow-lg w-full rounded px-3 py-1 text-white">{{item.speakers.length}}<i class="fa fa-eye"></i></span></div>
                <div class="table-cell bg-gray-200 text-gray-700 px-4 py-2 text-sm"><span v-if="item.waitinglist.length > 0" @click="loadList(item.waitinglist)" class="bg-red-700 px-2
                cursor-pointer hover:shadow-lg py-1 rounded text-white">({{item.waitinglist.length}}) Waiting List</span> <i class="fa fa-edit"></i> <i class="fa fa-trash-alt"></i></div>
            </div>
        </div>
    </div>
    <speaker class="absolute w-full p-2 min-h-full flex xs:flex-col rounded-lg bg-white top-0" v-bind:openSpeakers="openSpeakers" v-bind:speakers="eventSpeakers"></speaker>
    <event class="absolute w-full p-2 min-h-full flex xs:flex-col rounded-lg bg-white top-0" v-bind:openEvent="openEvent" v-bind:events="eventDetails"></event>
    <waiting-list class="absolute w-full p-2 min-h-full flex xs:flex-col rounded-lg bg-white top-0" v-bind:openList="waiting" v-bind:waitingList="waitingList"></waiting-list>
    <users-list class="absolute w-full p-2 min-h-full flex xs:flex-col rounded-lg bg-white top-0" v-bind:showUsers="showUsers" v-bind:userList="userList"></users-list>

</div>
</template>

<script>
import EventBus from '../event-bus'
export default {
    props: ['myprogrammes'],
    data() {
        return {
          openSpeakers: false,
          eventSpeakers: '',
          openEvent: false,
          eventDetails: '',
          waiting: false,
          waitingList: '',
          userList: '',
          showUsers: false
        }
    },
    methods:{
        loadSpeakers(speakers){
            this.eventSpeakers = speakers
            this.openSpeakers = true
        },

        loadEvents(events){
            this.eventDetails = events
            this.openEvent = true
        },

        loadList(list){
            this.waitingList = list
            this.waiting = true
        },

        loadUsers(users){
            this.userList = users
            this.showUsers = true
        }
    },
    mounted(){
       let vm = this;
         EventBus.$on('closeSpeakers', function (payLoad) {
            vm.openSpeakers = payLoad.action
          //  vm.programmeId = payLoad.progId
            });
       EventBus.$on('closeEvents', function (payLoad) {
            vm.openEvent = payLoad.action
          //  vm.programmeId = payLoad.progId
        });
       EventBus.$on('closewaitingList', function (payLoad) {
            vm.waiting = payLoad.action
          //  vm.programmeId = payLoad.progId
        });
        EventBus.$on('closeUsers', function (payLoad) {
            vm.showUsers = payLoad.action
          //  vm.programmeId = payLoad.progId
        });

    }

}
</script>

<style>

</style>
