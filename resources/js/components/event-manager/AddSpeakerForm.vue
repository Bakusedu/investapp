<template>
            <div class="flex-1 xs:m-0 xs:mt-5 m-3 flex-col flex xs:flex-col rounded-lg bg-white">
            <div class="w-full p-2 flex xs:flex-col rounded-lg bg-white">
               <div class="flex-col px-3 w-full relative ">

                    <!--Title-->
                    <div class="flex justify-between items-center pb-3">
                        <p class="text-2xl font-bold">Add speaker(s)</p>
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
                amount: 0,
                duration: '',
                venue: '',
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
