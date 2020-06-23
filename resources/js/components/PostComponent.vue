<template>

       <div class="flex-1 xs:m-0 xs:mt-5 m-3 flex-col flex xs:flex-col rounded-lg bg-white">
            <div class="w-full p-2 flex xs:flex-col rounded-lg bg-white">
               <div class="flex-col relative ">
                    <!--Title-->
                    <div class="flex justify-between items-center pb-3">
                        <p class="text-2xl font-bold">Create Programme</p>
                    </div>
                    <p v-if="errors.length">
                        <b><i class="fa fa-exclamation-triangle"></i>Please correct the following error(s):</b>
                        <ul>
                        <li class="text-red-600" v-for="(error,index) in errors" :key="index">{{ error }}</li>
                        </ul>
                    </p>


                    <form action="#" method="post" @submit="checkForm($event)" enctype="multipart/form-data">
                         <div class="flex xs:flex-col">
                            <div class="flex-col px-3 w-full">
                                <label class="block text-gray-700 text-sm font-bold m-2">
                                    Programme title
                                  </label>
                                <input required class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight w-full focus:outline-none focus:shadow-outline" v-model="title" value="" type="text" placeholder="Enter Programme title">
                            </div>
                            <div class="flex-col px-3 w-full">
                                <label class="block text-gray-700 text-sm font-bold m-2">
                                    Programme Duration
                                  </label>
                                <input required type="number" placeholder="Enter duration in days" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-model="duration">
                            </div>
                         </div>
                         <div class="flex xs:flex-col">
                         <div class="flex-col px-3 w-full">
                            <label class="block px-3 text-gray-700 text-sm font-bold m-2">
                                Start Date
                              </label>
                            <input required class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight w-full focus:outline-none focus:shadow-outline" v-model="startdate" value="" type="datetime-local">
                         </div>
                        <div class="flex-col px-3 w-full">
                            <label class="block text-gray-700 text-sm font-bold m-2">
                                Venue
                              </label>
                            <input required class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight w-full focus:outline-none focus:shadow-outline" v-model="venue" value="" type="text" placeholder="Enter Venue">
                        </div>
                        <div class="flex-col px-3 w-full">
                            <label class="block text-gray-700 text-sm font-bold m-2">
                                Maximum number of attendees
                              </label>
                            <input required type="number" placeholder="Enter number of Attendees expected" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            v-model="attendee">
                        </div>
                        </div>
                        <label class="px-6 py-6 font-bold">Choose Event Type</label>
                        <div class="p-3">
                            <label class="switch">
                                <input class="switch-input" type="checkbox" value=""/>
                                <span class="switch-label" data-on="Paid" @click="checkbox()" data-off="Free"></span>
                                <span class="switch-handle" @click="checkbox()"></span>
                            </label>
                        </div>
                        <input type="text" v-model="type" hidden name="type" id="">
                        <div v-show="paid" class="flex-col w-full px-6">
                            <label class="block text-gray-700 text-sm font-bold m-2">
                                Event Entry Fee
                              </label>
                            <input required type="number" placeholder="Enter Amount per attendee" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-model="amount">
                        </div>
                        <div class="flex-col px-3 w-full">
                            <label class="block text-gray-700 text-sm font-bold m-2">
                                Five key features of the event you wish to highlight to your target audience
                              </label>
                            <input required class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight w-full focus:outline-none focus:shadow-outline" v-model="highlight1" value="" type="text" placeholder="1.">
                            <input required class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight w-full focus:outline-none focus:shadow-outline" v-model="highlight2" value="" type="text" placeholder="2.">
                            <input required class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight w-full focus:outline-none focus:shadow-outline" v-model="highlight3" value="" type="text" placeholder="3.">
                            <input required class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight w-full focus:outline-none focus:shadow-outline" v-model="highlight4" value="" type="text" placeholder="4.">
                            <input required class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight w-full focus:outline-none focus:shadow-outline" v-model="highlight5" value="" type="text" placeholder="5.">
                        </div>
                        <label class="block text-gray-700 text-sm font-bold m-2">
                           Detailed Overview of the programme
                        </label>
                        <textarea v-model="overview" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" cols="30" rows="10"></textarea>
                        <div class="flex px-3 flex-col">
                        <div id="preview">
                            <img v-if="imageUrl" :src="imageUrl" />
                        </div>
                        <input type="file" ref="myFile" @change="selectedFile" accept="image/*" class="shadow w-2/12 appearance-none border rounded py-2 px-3 text-gray-700 leading-tight flex-none w-auto focus:outline-none focus:shadow-outline" name="featured" required >
                        <div v-if="imageError" class="imageError text-red-700 p-3">
                            {{imageError}}
                        </div>
                        </div>
                        <button class="font-semibold px-10 py-3 rounded bg-yellow-600"  v-bind:class="{ disabled: adding}" v-on:click="checkForm($event)"><p v-if="adding">Proccessing...</p><p v-else>Create Programme</p></button>
                    </form>
                </div>
                <!--/Dialog -->
            </div><!-- /Overlay -->

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
                //Events Data
                paid: false,
                type:'free',
                adding: false,
                inviteLink: '',
                programmeId: '',
                imageUrl: null,
                 errors: [],
                 imageError: '',
                imageFile: '',
                imageLoaded:false,
                enddate : '',
                startdate: '',
                overview: '',
                attendee: '',
                highlight: [],
                highlight1: '',
                highlight2: '',
                highlight3: '',
                highlight4: '',
                highlight5: '',
                title: '',
                feedback: false,
                amount: 0,
                duration: '',
                venue: '',
                open: true,
                events: false
            }
        },
        methods: {
        selectedFile() {
            this.imageError = '';

            let file = this.$refs.myFile.files[0];
            this.imageUrl = URL.createObjectURL(file)

            if(!file || file.type.indexOf('image/') !== 0) return;
            this.image.size = file.size;
            if(this.image.size > MAX_SIZE) {
                this.imageError.push(`The image size (${this.image.size}) is too much (max is ${MAX_SIZE}).`);
                return;
            }

            let reader = new FileReader();

            reader.readAsDataURL(file);
            reader.onload = evt => {
                let img = new Image();
                img.onload = () => {
                this.image.width = img.width;
                this.image.height = img.height;
                console.log(this.image);
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

            this.imageFile = file;

            reader.onerror = evt => {
                console.error(evt);
            }

        },
        checkForm: function (e) {
          let  d = []
            if (this.highlight1) {
                d.push(this.highlight1)
            }
            if (this.highlight2) {
                d.push(this.highlight2)
            }
            if (this.highlight3) {
                d.push(this.highlight3)
            }
            if (this.highlight4) {
                d.push(this.highlight4)
            }
            if (this.highlight5) {
                d.push(this.highlight5)
            }
            this.highlight = d
            console.log(d)
            this.errors = [];

            if (!this.title || this.title.length < 10) {
                this.errors.push('Title is required and must be more than 10 characters.');
            }
            if (!this.overview || this.overview.length < 200) {
                this.errors.push('Overview is required and must be atleast 200 characters.');
            }
            if (this.amount.length < 1) {
                this.errors.push('Fee is required, can be 0 for a free event.');
            }
            if (!this.attendee) {
                this.errors.push('Number of expected attendees cannot be empty');
            }
            if (!this.startdate) {
                this.errors.push('Start date is required');
            }
           if (!this.imageFile && this.imageError) {
                this.errors.push('Image field is required.');
            }
            if (this.highlight.length != 5) {
                this.errors.push('5 Key feature fields are required.');
            }
            if (this.errors.length > 0) {
            this.$notify({
            group: 'foo',
            title: 'Errors Found',
            text: 'Unable to submit form',
             type: 'warn',
             duration: 10000,
            });
            }
            e.preventDefault();
            if (this.errors.length == 0) {
                this.createProgram();
            }
        },
        createProgram(){

            let formdata = new FormData();
            formdata.append('image', this.image)
            formdata.append('startdate', this.startdate)
            formdata.append('desc', this.overview)
            formdata.append('title', this.title)
            formdata.append('duration', this.duration)
            formdata.append('featured', this.imageFile)
            formdata.append('type', this.type)
            formdata.append('amount', this.amount)
            formdata.append('venue', this.venue)
            formdata.append('highlight1', this.highlight1)
            formdata.append('highlight2', this.highlight2)
            formdata.append('highlight3', this.highlight)
            formdata.append('highlight4', this.highlight4)
            formdata.append('highlight5', this.highlight5)
            formdata.append('attendee', this.attendee)

        let vm = this
        axios.post( '/api/saveprogram',
            formdata,
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
           }
        ).then(function(response){
            console.log(response)
            vm.programmeId = response.data.id
           vm.$emit('close', true)
           vm.$notify({text: 'Programme is created'})
           vm.$notify({
            group: 'foo',
            title: 'Info',
            text: 'Invite speakers to your programme',
             duration: 10000,
            });
           vm.$router.push({name:"addevent", params:{programmeId: response.data.id}})

        })
        .catch(function(e){
            this.$notify({
                type: 'warn',
                text: 'unable to create a new programme'
                })
            });
        },

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
