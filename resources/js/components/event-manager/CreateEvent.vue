<template>
  <div class="flex-1 xs:m-0 xs:mt-5 m-3 flex-col flex xs:flex-col rounded-lg bg-white">
            <div class="w-full p-2 flex xs:flex-col rounded-lg bg-white">
               <div class="flex-col w-full relative ">

                    <!--Title-->
                    <div class="flex justify-between items-center pb-3">
                        <p class="text-base xs:px-3 xs:py-1 px-6 py-2 bg-gray-200 rounded font-bold">Add Event(s)</p>
                        <router-link class="text-base cursor-pointer xs:px-3 xs:py-1 px-6 py-2 shadow-md bg-yellow-600 rounded font-bold" :to="{ name: 'addspeaker', params: { programmeId: programmeId }}">Add Speakers</router-link>
                    </div>
                     <p v-if="errors.length">
                        <b><i class="fa fa-exclamation-triangle"></i>Please correct the following error(s):</b>
                        <ul>
                        <li class="text-red-600" v-for="(error,index) in errors" :key="index">{{ error }}</li>
                        </ul>
                    </p>

                        <div class="flex">
                            <div class="flex-none px-3 w-full">
                            <input required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" ref="eventTitle" type="text" placeholder="Enter  title">
                            </div>
                        </div>
                        <div class="flex flex-row w-full xs:flex-col pb-4">
                            <div class="flex-1 px-3">
                            <label class="block text-gray-700 text-sm font-bold m-2" > Start Date</label>
                            <input ref="eventStartDate" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  type="datetime-local" placeholder="Start Date">
                            </div>
                            <div class="flex-1 px-3 xs:w-full xs:flex-none">
                            <label class="block text-gray-700 text-sm font-bold m-2">End Date</label>
                            <input ref="eventEndDate" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="datetime-local" placeholder="End Date">
                            </div>
                        </div>
                        <label for="checkbox" class="font-bold">Tick if this task expects a feedback from attendee(s)</label>
                        <input type="checkbox" id="checkbox" v-model="feedback">
                        <div v-if="feedback">
                            <div class="flex-none flex-col">
                                <label for="" class="flex-none flex font-bold">Question</label>
                            <input type="text" ref="eventQuestion" class="px-3 flex shadow w-full py-2 appearance-none border rounded text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Write a Question">
                            </div>
                             <div class="flex-none flex-col">
                            <label for="" class="flex font-bold">Response Format</label>
                            <select ref="eventResponse" class="flex shadow appearance-none border rounded w-1/2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                                <option value="image">Image</option>
                                <option value="text">Text</option>
                                <option value="video">Video</option>
                                <option value="docs">Documents</option>
                            </select>
                            </div>
                        </div>
                        <label class="block text-gray-700 text-sm font-bold m-2">
                        Event Description
                        </label>
                        <textarea ref="eventDetails" required placeholder="Enter event details here" class="shadow px-3 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" cols="30" rows="10"></textarea>
                    <button @click="validateEvent" class="font-semibold px-10 py-3 rounded-t bg-yellow-600"><p v-if="adding">Proccessing...</p> <p v-else>Add to Programme</p></button>
                </div>
            </div>
             <!-- End Overlay for events -->
  </div>
</template>

<script>
const MAX_SIZE = 1000000;
const MAX_WIDTH = 720;
const MAX_HEIGHT = 720;
import EventBus from '../../event-bus';
    export default {
          props: ['programmeId'],
          data(){
            return {
                    image:{
                    size:'',
                    height:'',
                    width:''
                },
                //Events Data
                paid: false,
                type:'free',
                adding: false,
                inviteLink: '',
                imageUrl: null,
                 errors: [],
                 imageError: '',
                imageFile: '',
                imageLoaded:false,
                enddate : '',
                startdate: '',
                attendee: '',
                title: '',
                feedback: false,
                overview: '',
                amount: 0,
                duration: '',
                venue: '',
                open: true,
            }
        },
        methods: {

        validateEvent(){
            console.log(this.feedback)
          let startDate = this.$refs.eventStartDate.value;
          let endDate = this.$refs.eventEndDate.value;
          let details = this.$refs.eventDetails.value;
          let title = this.$refs.eventTitle.value;
          let feedback = this.feedback
            if (this.feedback) {
            let question = this.$refs.eventQuestion.value
            let format = this.$refs.eventResponse.value
            }
           this.errors = []
           if (!startDate) {
               this.errors.push('Event Start Date is required')
           }
           if (!endDate) {
               this.errors.push('Event End Date is required')
           }
           if (!details) {
               this.errors.push('Event details is required')
           }
           if (!title) {
               this.errors.push('Event title is required')
           }
           if (this.feedback) {
               if (!this.$refs.eventQuestion.value) {
                   this.errors.push('Feedback Question is required')
               }
                if (!this.$refs.eventQuestion.value) {
                   this.errors.push('Feedback Format is required')
               }
           }
           if (this.errors.length == 0) {
               this.adding = true
               this.addEvent()
           }
        },

        addEvent(){
             let formdata = new FormData();
            formdata.append('programmeId', this.programmeId)
            formdata.append('startdate', this.$refs.eventStartDate.value)
            formdata.append('title', this.$refs.eventTitle.value)
            formdata.append('enddate', this.$refs.eventEndDate.value)
            formdata.append('useFeedback', this.feedback)
            if (this.feedback) {
                    formdata.append('question', this.$refs.eventQuestion.value)
                formdata.append('feedbackType', this.$refs.eventResponse.value)
            }
            formdata.append('details', this.$refs.eventDetails.value)

        let vm = this
        axios.post( '/api/addevent',
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
            text: 'Speaker added',
            type: 'success',
             duration: 10000,
            });
           vm.adding = false
        })
        .catch(function(e){
           vm.adding = false
            vm.$notify({
                type: 'warn',
                text: 'unable to add speaker'
                })
            });
        },
         checkbox(){
        this.paid = !this.paid,
        this.paid ? this.type = 'paid' : this.type = "free";
        console.log(this.type)
        }
    },
    mounted () {
        let vm  = this
    EventBus.$on('events', function (payLoad) {
            vm.events = payLoad.event
            vm.programmeId = payLoad.progId

    });
  }
}
</script>

<style>

#preview img {
  max-width: 200px;
  max-height: 200px;
}
</style>
