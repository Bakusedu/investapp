<template>
  <div class="flex-col absolute overflow-x-auto shadow-2xl z-10 left-0" v-if="openList == true">
      <div class="text-lg font-bold"><span><i class="fa fa-calendar-alt"></i>Event Waiting List</span>
        </div>
      <div class="absolute" style="right:40px; top: 10px;">
          <span class="bg-red-700 px-2 py-1 rounded-full cursor-pointer text-white" @click="close">Close</span>
      </div>
     <div class="table w-full pb-2 rounded shadow-2xl">
        <div class="table-header-group border">
            <div class="table-row table-caption font-bold">
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm">User Name</div>
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm">Status</div>
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm">Email</div>
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm">Phone Number</div>
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm">Submitted Date</div>
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm">Actions</div>
            </div>
        </div>
        <div class="table-row-group">
            <div class="table-row" v-for="(item,index) in waitingList" :key="index">
                <div class="table-cell bg-gray-200 text-gray-700 px-4 py-2 text-sm">{{item.username}}</div>
                <div class="table-cell bg-gray-400 text-gray-700 px-4 w-48 py-2 text-sm">
                    <span class="text-white bg-indigo-900 p-1 px-3">{{item.status}}</span>
                </div>
                <div class="table-cell bg-gray-200 text-gray-700 w-48 px-4 py-2 text-sm">{{item.email}}</div>
                <div class="table-cell bg-gray-200 text-gray-700 px-4 w-4 overflow-hidden py-2 text-sm">{{item.phone}} </div>
                <div class="table-cell bg-gray-400  text-gray-700 px-4 py-2 w-48 text-sm"> {{ item.created_at | moment("MMMM Do YYYY") }} </div>
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm"><span class="cursor-pointer bg-yellow-700 text-white hover:shadow-lg rounded p-1 px-3" v-if="item.status == 'pending'">Approve</span><span v-else>Accepted</span></div>
            </div>
        </div>
     </div>
     </div>
</template>

<script>

const MAX_SIZE = 1000000;
const MAX_WIDTH = 720;
const MAX_HEIGHT = 720;
import EventBus from '../../event-bus'
export default {
    props: ['openList', 'waitingList'],
    data() {
        return {
            image:{
                    size:'',
                    height:'',
                    width:''
                },
            editEvent: false,
            errors: [],
            event:{
                title: '',
                details: '',
                start_date: '',
                end_date: '',
                use_feedback: '',
                question: '',
                feedback_type: '',
                id: ''
            },
            adding:false
        }
    },
    methods:{
        close(event){
          let payload = {'action': false,}
         EventBus.$emit('closewaitingList', payload)
        },

        edit(item){
            this.event = item
            this.editEvent = true
        },

        addEvent(){
           this.adding = true
             let formdata = new FormData();
            formdata.append('eventId', this.event.id)
            formdata.append('startdate', this.event.start_date)
            formdata.append('title', this.event.title)
            formdata.append('enddate', this.event.end_date)
            formdata.append('useFeedback', this.event.use_feedback)
            formdata.append('question', this.event.question)
            formdata.append('feedbackType', this.event.feedback_type)
            formdata.append('details', this.event.details)

        let vm = this
        axios.post( '/api/editevent',
            formdata,
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
           }
        ).then(function(response){

           vm.$notify({
            group: 'foo',
            title: 'success',
            text: 'Event Updated',
            type: 'success',
             duration: 10000,
            });
           vm.adding = false
        })
        .catch(function(e){
           vm.adding = false
            vm.$notify({
                type: 'warn',
                text: 'unable to update event'
                })
            });
        },

    },
    computed: {
        baseurl: function () {
            return window.location.origin
        }
    }
}
</script>

<style>

</style>
