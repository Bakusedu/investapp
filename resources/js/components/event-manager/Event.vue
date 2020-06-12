<template>
  <div class="flex-col absolute overflow-x-auto shadow-2xl z-10 left-0" v-if="openEvent == true">
      <div class="text-lg font-bold"><span><i class="fa fa-calendar-alt"></i>Events</span>
        </div>
      <div class="absolute" style="right:40px; top: 10px;">
          <span class="bg-red-700 px-2 py-1 rounded-full cursor-pointer text-white" @click="close">Close</span>
      </div>
     <div class="table w-full rounded shadow-2xl">
        <div class="table-header-group border">
            <div class="table-row table-caption font-bold">
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm">Title</div>
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm">Details</div>
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm">Task</div>
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm">Feed Back</div>
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm">Invitation <br/>Link</div>
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm">Duration</div>
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm">Actions</div>
            </div>
        </div>
        <div class="table-row-group">
            <div class="table-row" v-for="(item,index) in events" :key="index">
                <div class="table-cell bg-yellow-200 text-gray-700 px-4 py-2 text-sm">{{item.title}}</div>
                <div class="table-cell bg-gray-400 text-gray-700 px-4 w-48 py-2 text-sm">
                    {{item.details}}
                </div>
                <div class="table-cell bg-yellow-200 text-gray-700 w-48 px-4 py-2 text-sm">{{item.question}}</div>
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm"><p v-if="item.use_feedback">Feedbacks (0)</p><p v-else>Not Accepted</p></div>
                <div class="table-cell bg-yellow-200 text-gray-700 px-4 w-4 overflow-hidden py-2 text-sm">{{ baseurl + '/programme/details?id='+item.id}} </div>
                <div class="table-cell bg-gray-400  text-gray-700 px-4 py-2 w-48 text-sm"> {{ item.start_date | moment("MMMM Do YYYY") }} - {{ item.end_date | moment( "MMMM Do YYYY") }}</div>
                <div class="table-cell bg-yellow-200 text-gray-700 px-4 py-2 text-sm"><i @click="edit(item)" class="fa fa-edit"></i> <i class="fa fa-trash-alt"></i></div>
            </div>
        </div>
     </div>
             <div v-if="editEvent" class="absolute bg-white w-9/12 xs:w-full h-auto overflow-y-auto md:max-w-md z-30 rounded shadow  px-8 text-left p-6 pb-6" style="top: 60px">
                    <!--Title-->
                    <div class="flex justify-between items-center pb-3">
                        <p class="text-base px-6 bg-gray-200 rounded font-bold">Update Event</p>
                        <div class="cursor-pointer z-50" @click="editEvent = false">
                            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                            </svg>
                        </div>
                    </div>
                     <p v-if="errors.length">
                        <b><i class="fa fa-exclamation-triangle"></i>Please correct the following error(s):</b>
                        <ul>
                        <li class="text-red-600" v-for="(error,index) in errors" :key="index">{{ error }}</li>
                        </ul>
                    </p>

                        <div class="flex">
                            <div class="flex-none w-full">
                            <input required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-model="event.title" type="text" placeholder="Enter  title">
                            </div>
                        </div>
                        <div class="flex flex-row w-full pb-4">
                            <div class="flex-1">
                            <label class="block text-gray-700 text-sm font-bold m-2" > Start Date</label>
                            <input v-model="event.start_date" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  type="datetime-local" placeholder="Start Date">
                            </div>
                            <div class="flex-1">
                            <label class="block text-gray-700 text-sm font-bold m-2">End Date</label>
                            <input v-model="event.end_date" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="datetime-local" placeholder="End Date">
                            </div>
                        </div>
                        <label for="checkbox" class="font-bold">Tick if this task expects a feedback from attendee(s)</label>
                        <input type="checkbox" id="checkbox" v-model="event.use_feedback">
                        <div v-if="event.use_feedback">
                            <div class="flex-none flex-col">
                                <label for="" class="flex-none flex font-bold">Question</label>
                            <input type="text" v-model="event.question" class="px-3 flex shadow w-full py-2 appearance-none border rounded text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Write a Question">
                            </div>
                             <div class="flex-none flex-col">
                            <label for="" class="flex font-bold">Response Format</label>
                            <select v-model="event.feedback_type" class="flex shadow appearance-none border rounded w-1/2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                                <option value="image">Image</option>
                                <option value="text">Text</option>
                                <option value="video">Video</option>
                                <option value="docs">Documents</option>
                            </select>
                            </div>
                        </div>
                        <label class="block text-gray-700 text-sm font-bold m-2">
                        Event Details
                        </label>
                        <textarea v-model="event.details" required placeholder="Enter event details here" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" cols="30" rows="10"></textarea>
                    <button @click="addEvent" class="font-semibold px-10 py-3 rounded-t bg-yellow-600"><p v-if="adding">Proccessing...</p> <p v-else>Update Event</p></button>
                </div>
     </div>
</template>

<script>

const MAX_SIZE = 1000000;
const MAX_WIDTH = 720;
const MAX_HEIGHT = 720;
import EventBus from '../../event-bus'
export default {
    props: ['openEvent', 'events'],
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
         EventBus.$emit('closeEvents', payload)
            console.log('emitted')
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

        copyInviteLink () {

          let testingCodeToCopy = document.querySelector('#testing-code')
          testingCodeToCopy.setAttribute('type', 'text')
          testingCodeToCopy.select()
            let vm = this
          try {
            var successful = document.execCommand('copy');
             vm.$notify({
                type: 'success',
                text: 'invite link is copied to clipboard'
                });
          } catch (err) {
             vm.$notify({
                type: 'warn',
                text: 'unable to copy'
                })
          }

          /* unselect the range */
          testingCodeToCopy.setAttribute('type', 'hidden')
          window.getSelection().removeAllRanges()
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
