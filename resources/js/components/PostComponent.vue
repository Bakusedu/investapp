<template>

        <div class="h-full">
              <!--Overlay-->
             <div style="background-color: rgba(0,0,0,0.5)" v-if="create == true" class="absolute inset-0 z-40 flex items-center justify-center" >
                <!--Dialog-->
                <div class="bg-white w-9/12 xs:w-full h-screen overflow-y-auto md:max-w-md mx-auto rounded shadow-lg py-4 mt-20 text-left pt-20 pb-40 px-6" style="top: 30px">

                    <!--Title-->
                    <div class="flex justify-between items-center pb-3">
                        <p class="text-2xl font-bold">Create Programme</p>
                        <div class="cursor-pointer z-50" @click="hide()">
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


                    <form action="#" method="post" @submit="checkForm($event)" enctype="multipart/form-data">
                         <div class="flex xs:flex-col">
                            <div class="flex-col w-full">
                                <label class="block text-gray-700 text-sm font-bold m-2">
                                    Programme title
                                  </label>
                                <input required class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight w-full focus:outline-none focus:shadow-outline" v-model="title" value="" type="text" placeholder="Enter Programme title">
                            </div>
                            <div class="flex-col w-full">
                                <label class="block text-gray-700 text-sm font-bold m-2">
                                    Programme Duration
                                  </label>
                                <input required type="number" placeholder="Enter duration in days" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-model="duration">
                            </div>
                         </div>
                         <div class="flex xs:flex-col">
                         <div class="flex-col w-full">
                            <label class="block text-gray-700 text-sm font-bold m-2">
                                Start Date
                              </label>
                            <input required class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight w-full focus:outline-none focus:shadow-outline" v-model="startdate" value="" type="datetime-local">
                         </div>
                            <div class="flex-col w-full">
                            <label class="block text-gray-700 text-sm font-bold m-2">
                                Event Entry Fee
                              </label>
                            <input required type="number" placeholder="Enter Amount per attendee" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-model="amount">
                        </div>
                        </div>
                        <div class="flex xs:flex-col">
                        <div class="flex-col w-full">
                            <label class="block text-gray-700 text-sm font-bold m-2">
                                Venue
                              </label>
                            <input required class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight w-full focus:outline-none focus:shadow-outline" v-model="venue" value="" type="text" placeholder="Enter Venue">
                        </div>
                        <div class="flex-col w-full">
                            <label class="block text-gray-700 text-sm font-bold m-2">
                                Maximum number of attendees
                              </label>
                            <input required type="number" placeholder="Enter number of Attendees expected" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            v-model="attendee">
                        </div>
                        </div>
                        <label class="font-bold">Choose Event Type</label>
                        <div class="flex">
                         <div class="flex-col border">
                            <label for="" class="block text-gray-700 text-sm font-bold m-2">Free Event</label>
                            <input type="radio" v-model="type" class="shadow" value="free">
                         </div>
                        <div class="flex-col border">
                            <label for="" class="block text-gray-700 text-sm font-bold m-2">Paid Event</label>
                            <input type="radio" v-model="type" class="shadow" value="paid">
                        </div>
                        </div>
                        <div class="flex-col w-full">
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
                        <div class="flex flex-row">
                        <div id="preview">
                            <img v-if="imageUrl" :src="imageUrl" />
                        </div>
                        <input type="file" ref="myFile" @change="selectedFile" accept="image/*" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight flex-none w-auto focus:outline-none focus:shadow-outline" name="featured" required >
                        <div v-if="imageError" class="imageError">
                            {{imageError}}
                        </div>
                        </div>
                        <button class="font-semibold px-10 py-3 rounded-t bg-yellow-600"  v-bind:class="{ disabled: adding}" v-on:click="checkForm($event)"><p v-if="adding">Proccessing...</p><p v-else>Create Programme</p></button>
                    </form>
                </div>
                <!--/Dialog -->
            </div><!-- /Overlay -->
                <!--Overlay-->
                <div v-if="events == true" @events="events = true" class="absolute inset-0 xs:mt-56 mt-40 z-40 flex items-center justify-center" >
                <!--Dialog-->
                <div class="bg-white w-9/12 xs:w-full h-auto overflow-y-auto md:max-w-md mx-auto rounded shadow py-4 px-8 mt-20 text-left pt-30 pb-40" style="top: 60px">

                    <!--Title-->
                    <div class="flex justify-between items-center pb-3">
                        <p class="text-base px-6 py-2 bg-gray-200 rounded font-bold">Add Event(s)</p>
                        <p @click="speakers = true" class="text-base cursor-pointer px-6 py-2 shadow-md bg-yellow-600 rounded font-bold">Add Speakers</p>
                        <div class="cursor-pointer z-50" @click="events = false">
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
                            <input required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" ref="eventTitle" type="text" placeholder="Enter  title">
                            </div>
                        </div>
                        <div class="flex flex-row w-full xs:flex-col pb-4">
                            <div class="flex-1">
                            <label class="block text-gray-700 text-sm font-bold m-2" > Start Date</label>
                            <input ref="eventStartDate" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  type="datetime-local" placeholder="Start Date">
                            </div>
                            <div class="flex-1 xs:w-full xs:flex-none">
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
                        <textarea ref="eventDetails" required placeholder="Enter event details here" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" cols="30" rows="10"></textarea>
                    <button @click="validateEvent" class="font-semibold px-10 py-3 rounded-t bg-yellow-600"><p v-if="adding">Proccessing...</p> <p v-else>Add to Calendar</p></button>
                </div>
            </div>
             <!-- End Overlay for events -->
                          <!--Overlay-->
             <div v-if="speakers == true" class="absolute inset-0 mt-12 xs:pt-64 z-50 flex items-center justify-center" >
                <!--Dialog-->
                <div class="bg-white w-9/12 xs:w-full h-auto md:max-w-md mx-auto rounded shadow-lg pb-32 xs:pt-64 pt-56 text-left p-4 px-6" style="top: 60px">

                    <!--Title-->
                    <div class="flex justify-between items-center pb-3">
                        <p class="text-2xl font-bold">Add speaker(s)</p>
                        <div class="cursor-pointer z-50" @click="speakers = false">
                            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                            </svg>
                        </div>
                    </div>
                    <form action="#" method="post" @submit="checkSpeakerForm($event)" enctype="multipart/form-data">
                        <div class="xl:flex lg:flex md:flex xs:flex-none  sm:flex-none">
                            <div class="flex-row w-1/2 xs:w-full sm:w-full">
                                <label class="block text-gray-700 text-sm font-bold m-2">
                                    Speaker Name
                                  </label>
                                <input required class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight w-full focus:outline-none focus:shadow-outline" v-model="speaker.name" value="" type="text" placeholder="Enter Speaker Name">
                                 <label class="block text-gray-700 text-sm font-bold m-2">
                                    Speaker Email
                                  </label>
                                <input required class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight w-full focus:outline-none focus:shadow-outline" v-model="speaker.email" value="" type="text" placeholder="Enter Speaker Name">
                                <label class="block text-gray-700 text-sm font-bold m-2">
                                   Organization
                                  </label>
                                <input required type="text" placeholder="Example: LiftHub, Amazon" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-model="speaker.organization">
                                <label class="block text-gray-700 text-sm font-bold m-2">
                                    Title
                                </label>
                                <input required type="text" placeholder="CEO, Manager" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-model="speaker.title">
                                <label class="block text-gray-700 text-sm font-bold m-2">
                                    Facebook Profile
                                  </label>
                                <input ref="facebook" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight w-full focus:outline-none focus:shadow-outline" v-model="speaker.facebook"  value="" type="text" placeholder="Link to speaker's facebook profile (optional)">
                                <label class="block text-gray-700 text-sm font-bold m-2">
                                    Twitter
                                  </label>
                                <input ref="twitter" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight w-full focus:outline-none focus:shadow-outline" v-model="speaker.twitter"  value="" type="text" placeholder="Link to speaker's twitter handle (optional)">
                                 <label class="block text-gray-700 text-sm font-bold m-2">
                                    linkedIn
                                  </label>
                                <input  class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight w-full focus:outline-none focus:shadow-outline" v-model="speaker.linkedIn"  value="" type="text" placeholder="Link to speaker's linkedIn (optional)">
                            </div>
                            <div class="p-16 flex-col w-1/2 xs:flex-row sm:w-full sm:flex-row xs:w-full">
                                <div @click="trigger" class="border hover:shadow-lg flex flex-row justify-center items-center h-64 w-64" :style="{backgroundImage: `url( ${speakerFileUrl} )`, backgroundSize:'cover', backgroundSize:'no-repeat', backgroundPosition: 'center'}">
                                    <p v-if="speakerImage == null" class="text-black">Click to add Image</p>
                                    <input hidden ref="speakerFile" @change="speakerFileValidation" type="file">
                                </div>
                                <span v-if="speakerFileError" class="text-gray-700">
                                    <span class="text-yellow-500"><i class="fa fa-exclamation-triangle"></i></span> {{speakerFileError}}
                                </span>
                                 <p v-if="errors.length">
                                    <b><i class="fa fa-exclamation-triangle"></i>Please correct the following error(s):</b>
                                    <ul>
                                    <li class="text-red-600" v-for="(error,index) in errors" :key="index">{{ error }}</li>
                                    </ul>
                                </p>
                            </div>
                         </div>
                         <div class="flex">
                            <div class="flex-col w-full">
                                <label for="">Copy Unique Invite Link</label>
                                <input type="text" :value="inviteLink">
                            </div>
                         </div>
                        <button class="font-semibold px-10 py-3 mt-5 rounded-t bg-yellow-600"  v-bind:class="{ disabled: adding,}" v-on:click="checkSpeakerForm($event)"><b v-if="adding == true">Proccessing...</b> <b v-else>Add Speaker</b> </button>
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
            props:['create'],
          data(){
            return {
                    image:{
                    size:'',
                    height:'',
                    width:''
                },
                //Events Data


                adding: false,
                inviteLink: '',
                programmeId: '',
                imageUrl: null,
                speakerFileUrl: null,
                speakerFileError: '',
                speakerImage: null,
                 errors: [],
                 imageError: '',
                imageFile: '',
                imageLoaded:false,
                enddate : '',
                startdate: '',
                attendee: '',
                highlight: [],
                highlight1: '',
                highlight2: '',
                highlight3: '',
                highlight4: '',
                highlight5: '',
                title: '',
                feedback: false,
                overview: '',
                amount: '',
                duration: '',
                venue: '',
                type: '',
                open: true,
                speakers: false,
                speaker:{
                    facebook: '',
                    twitter: '',
                    linkedIn: '',
                    name: '',
                    email: '',
                    organization: '',
                    title: ''
                },
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
                this.errors.push('Fee is required, can must 0 for a free event.');
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
           vm.events = true

        })
        .catch(function(e){
            this.$notify({
                type: 'warn',
                text: 'unable to create a new programme'
                })
            });
        },

        hide(event){
            this.$emit('close', true)
        },

        trigger(){
            this.$refs.speakerFile.click()
        },
        speakerFileValidation() {
            this.speakerFileError = '';

            let speakerFile = this.$refs.speakerFile.files[0];
            this.speakerFileUrl = URL.createObjectURL(speakerFile)

            if(!speakerFile || speakerFile.type.indexOf('image/') !== 0) return;
            this.image.size = speakerFile.size;
            if(this.image.size > MAX_SIZE) {
                this.speakerFileError= `The image size (${this.image.size}) is too much (max is ${MAX_SIZE}).`;
                return;
            }

            let reader = new FileReader();

            reader.readAsDataURL(speakerFile);
            reader.onload = evt => {
                let img = new Image();
                img.onload = () => {
                this.image.width = img.width;
                this.image.height = img.height;
                console.log(this.image);
                if(this.image.width > MAX_WIDTH) {
                    this.speakerFileError = `The image width (${this.image.width}) is too much (max is ${MAX_WIDTH}).`;
                    return;
                }
                if(this.image.height > MAX_HEIGHT) {
                    this.speakerFileError = `The image height (${this.image.height}) is too much (max is ${MAX_HEIGHT}).`;
                    return;
                }

            }
                img.src = evt.target.result;
            }

            this.speakerImage = speakerFile;

            reader.onerror = evt => {
                console.error(evt);
            }

        },
        ValidateEmail(mail)
        {
          if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))
        {
            return (true)
        }
            return (false)
        },
        validURL(str) {
            var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
                '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
                '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
                '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
                '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
                '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
            return !!pattern.test(str);
        },
        checkSpeakerForm: function (e) {
            this.errors = [];
            if (!this.speaker.title) {
                this.errors.push('Speaker\'s Title is required.');
            }
            if (!this.speaker.name || this.speaker.name.length < 5) {
                this.errors.push('Enter a valid name.');
            }
            if (!this.speaker.organization) {
                this.errors.push('Speaker organization cannot be empty');
            }
            if (this.speaker.facebook) {
               let url = this.validURL(this.speaker.facebook)

               url ? true : this.errors.push('The facebook URL is invalid');
            }
            if (this.speaker.twitter) {
               let url = this.validURL(this.speaker.twitter)

               url ? true : this.errors.push('The Twitter URL is invalid');
            }
            if (this.speaker.linkedIn) {
               let url = this.validURL(this.speaker.linkedIn)

               url ? true : this.errors.push('The speaker linkedIn URL is invalid');
            }
             if (!this.speaker.email || !this.speaker.email) {
               let email = this.ValidateEmail(this.speaker.email)

               email ? true : this.errors.push('The speaker email is invalid');
            }
            if (!this.speakerImage || this.speakerFileError) {
                this.errors.push('Image field is required.');
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
                this.addSpeaker();
            }
        },
        addSpeaker(){
            this.adding = true;
            let formdata = new FormData();
            formdata.append('programmeId', this.programmeId)
            formdata.append('image', this.speakerImage)
            formdata.append('title', this.speaker.title)
            formdata.append('name', this.speaker.name)
            formdata.append('facebook', this.speaker.facebook)
            formdata.append('twitter', this.speaker.twitter)
            formdata.append('linkedIn', this.speaker.linkedIn)
            formdata.append('organization', this.speaker.organization)
            formdata.append('email', this.speaker.email)

        let vm = this
        axios.post( '/api/addspeaker',
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
           vm.speakers = true
           vm.adding = false
           vm.inviteLink = response.data.invite_link

        })
        .catch(function(e){
           vm.adding = false
            vm.$notify({
                type: 'warn',
                text: 'unable to add speaker'
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
