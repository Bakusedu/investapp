<template>

        <div>
              <!--Overlay-->
             <div v-if="edit == true" class="z-40 flex items-center justify-center" >
                <!--Dialog-->
                <div class="bg-white w-9/12 xs:w-full h-auto opacity-100 md:max-w-md mx-auto rounded shadow-lg py-4 text-left px-6">

                    <!--Title-->
                    <div class="flex justify-between items-center pb-3">
                        <p class="text-2xl font-bold">{{programme.programme.title}}</p>
                         <p @click="openEventForm" class="text-base bg-yellow-600 rounded cursor-pointer px-3 xs:text-sm xs:w-32 shadow-md font-bold">Add Events and Speakers</p>
                        <div class="cursor-pointer z-50" @click="hide()">
                            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="25" height="30" viewBox="0 0 18 18">
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
                         <div class="flex xs:flex-col flex-row">
                            <div class="flex-col xs:flex-none xs:flex-row flex-1 xs:w-full">
                                <label class="block text-gray-700 text-sm font-bold m-2">
                                    Programme title
                                  </label>
                                <input required class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight w-11/12 xs:w-full focus:outline-none focus:shadow-outline" :value="programme.programme.title" ref="title" type="text" placeholder="Enter Programme title">
                            </div>
                            <div class="flex-col xs:flex-none xs:flex-row xs:w-full">
                                <label class="block text-gray-700 text-sm font-bold m-2">
                                    Programme Duration
                                  </label>
                                <input required type="number" placeholder="Enter duration in days" class="shadow w-11/12 appearance-none border rounded xs:w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" :value="programme.programme.duration" ref="duration" >
                            </div>
                         </div>
                         <div class="flex xs:flex-col ">
                         <div class="flex-col xs:flex-none w-full">
                            <label class="block text-gray-700 text-sm font-bold m-2">
                                Start Date
                              </label>
                            <input required class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight w-11/12 xs:w-full focus:outline-none focus:shadow-outline" :value="programme.programme.startdate" ref="startdate" type="datetime-local">
                         </div>
                            <div class="flex-col xs:flex-none w-full">
                            <label class="block text-gray-700 text-sm font-bold m-2">
                                Event Entry Fee
                              </label>
                            <input :value="programme.programme.fee" ref="fee" required type="number" placeholder="Enter Amount per attendee" class="shadow appearance-none border rounded w-11/12 xs:w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        </div>
                        <div class="flex xs:flex-col ">
                        <div class="flex-col xs:flex-none w-full">
                            <label class="block text-gray-700 text-sm font-bold m-2">
                                Venue
                              </label>
                            <input required class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight w-11/12 xs:w-full focus:outline-none focus:shadow-outline" :value="programme.programme.venue" ref="venue" type="text" placeholder="Enter Venue">
                        </div>
                        <div class="flex-col xs:flex-none w-full">
                            <label class="block text-gray-700 text-sm font-bold m-2">
                                Maximum number of attendees
                              </label>
                            <input required type="number" placeholder="Enter number of Attendees expected" class="shadow appearance-none border rounded w-11/12 xs:w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            :value="programme.programme.attendee" ref="attendee">
                        </div>
                        </div>
                        <label>Choose Event Type</label>
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
                        <div class=" space-y-1 flex-col w-full">
                            <label class="block text-gray-700 text-lg font-bold m-2">
                                Five key features of the event you wish to highlight to your target audience
                              </label>
                            <input required class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight w-full focus:outline-none focus:shadow-outline" :value="JSON.parse(programme.programme.key_features)[0]" ref="highlight1" type="text" placeholder="1.">
                            <input required class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight w-full focus:outline-none focus:shadow-outline" ref="highlight2" :value="JSON.parse(programme.programme.key_features)[1]" type="text" placeholder="2.">
                            <input required class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight w-full focus:outline-none focus:shadow-outline" ref="highlight3" :value="JSON.parse(programme.programme.key_features)[2]" type="text" placeholder="3.">
                            <input required class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight w-full focus:outline-none focus:shadow-outline" ref="highlight4" :value="JSON.parse(programme.programme.key_features)[3]" type="text" placeholder="4.">
                            <input required class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight w-full focus:outline-none focus:shadow-outline" ref="highlight5" :value="JSON.parse(programme.programme.key_features)[4]" type="text" placeholder="5.">
                        </div>
                        <label class="block text-gray-700 text-sm font-bold m-2">
                           Detailed Overview of the programme
                        </label>
                        <textarea ref="overview" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" :value="programme.programme.overview" cols="30" rows="10"></textarea>
                        <div id="preview">
                            <img v-if="imageUrl" :src="imageUrl" />   <img v-else :src="'/files/images?filename=' + programme.programme.featured"  />
                        </div>
                        <input type="file" ref="myFile" @change="selectedFile" accept="image/*" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight flex-none w-auto focus:outline-none focus:shadow-outline" name="featured" required >
                        <div v-if="imageError" class="imageError">
                            {{imageError}}
                        </div>
                        <button class="font-semibold px-10 py-3 rounded-t bg-yellow-600"  v-bind:class="{ disabled: addingSpeaker}" v-on:click="checkForm($event)"><p v-if="addingSpeaker">Proccessing...</p><p v-else>Update and Add Speakers</p></button>
                    </form>
                </div>
                <!--/Dialog -->
            </div><!-- /Overlay -->

                          <!--Overlay-->
             <div v-if="speakers == true" class="absolute xs:pt-64 z-40 flex items-center justify-center" >
                <!--Dialog-->
                <div class="bg-white w-9/12 xs:w-full h-auto md:max-w-md mx-auto rounded shadow-lg pb-3 xs:pt-64 text-left p-4 px-6">

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
                                 <span class="title">Speaker Invite Link:</span>
                                        <span class="code shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight w-full focus:outline-none focus:shadow-outline text-red">{{ inviteLink }}</span>
                                        <span class="bg-blue-500 text-white ml-auto" @click.stop.prevent="copyInviteLink">
                                            Copy
                                </span>
                                <input type="hidden" id="testing-code" :value="inviteLink">
                            </div>
                         </div>
                        <button class="font-semibold px-10 py-3 mt-5 rounded-t bg-yellow-600"  v-bind:class="{ disabled: addingSpeaker,}" v-on:click="checkSpeakerForm($event)"><b v-if="addingSpeaker == true">Proccessing...</b> <b v-else>Add Speaker</b> </button>
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
            props:['edit', 'programme'],
          data(){
            return {
                    image:{
                    size:'',
                    height:'',
                    width:''
                },
                addingSpeaker: false,
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
                title: this.programme ? this.programme.title : '',
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
                }
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
        this.highlight1 = this.$refs.highlight1.value
        this.highlight2 = this.$refs.highlight2.value
        this.highlight3 = this.$refs.highlight3.value
        this.highlight4 = this.$refs.highlight4.value
        this.highlight5 = this.$refs.highlight5.value
        this.title = this.$refs.title.value
        this.venue = this.$refs.venue.value
        this.attendee = this.$refs.attendee.value
        this.startdate = this.$refs.startdate.value
        this.amount = this.$refs.fee.value
        this.duration = this.$refs.duration.value
        this.overview = this.$refs.overview.value

           console.log(this.$refs.highlight4.value)
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
           if ( this.imageError) {
                this.errors.push('Image not accepted.');
            }
           if ( !this.type) {
                this.errors.push('The programme type field is required.');
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
            formdata.append('programmeId', this.programme.programme.id)
        let vm = this
        axios.post( '/api/updateprogram',
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
           vm.speakers = true

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
            this.addingSpeaker = true;
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
           vm.addingSpeaker = false
           vm.inviteLink = response.data.invite_link

        })
        .catch(function(e){
           vm.addingSpeaker = false
            vm.$notify({
                type: 'warn',
                text: 'unable to add speaker'
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
        openEventForm(event){
         let payload = {'event': true, 'edit': false, 'progId': this.programme.programme.id}
         EventBus.$emit('events', payload)
            console.log('emitted')

        },
    },

}
</script>

<style>

#preview img {
  max-width: 200px;
  max-height: 200px;
}
</style>
