<template>
  <div class="flex-col absolute overflow-x-auto shadow-2xl z-10 left-0" v-if="openSpeakers == true">
       <div class="text-lg font-bold"><span><i class="fa fa-calendar-alt"></i>Speakers</span>
       </div>
      <div class="absolute" style="right:40px; top: 10px;">
          <span class="bg-red-700 px-2 py-1 cursor-pointer rounded-full text-white" @click="close">Close</span>
      </div>
     <div class="table shadow-2xl w-full">
        <div class="table-header-group border">
            <div class="table-row table-caption font-bold">
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm">Name</div>
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm">Picture</div>
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm">Company</div>
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm">Invitation<br/> Status</div>
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm">Invitation <br/>Link</div>
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm">Email</div>
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm">Actions</div>
            </div>
        </div>
        <div class="table-row-group">
            <div class="table-row" v-for="(item,index) in speakers" :key="index">
                <div class="table-cell bg-gray-200 text-gray-700 px-4 py-2 text-sm">{{item.name}}</div>
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm">
                    <img :src="'/files/images?filename='+item.image" class="w-16 h-16 object-center" alt="">
                </div>
                <div class="table-cell bg-gray-200 text-gray-700 px-4 py-2 text-sm">{{item.organization}}</div>
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm"><p v-if="item.invite_accepted">Accepted</p><p v-else>Not Accepted</p></div>
                <div class="table-cell bg-gray-200 text-gray-700 px-4 w-4 overflow-hidden py-2 text-sm">{{ baseurl + '/invite/'+item.invite_id}} </div>
                <div class="table-cell bg-gray-400  text-gray-700 px-4 py-2 w-4 text-sm"><i class="fa fa-envelope"></i> {{item.email}}</div>
                <div class="table-cell bg-gray-200 text-gray-700 px-4 py-2 text-sm"><i @click="edit(item)" class="fa fa-edit"></i> <i class="fa fa-trash-alt"></i></div>
            </div>
        </div>
     </div>
        <div v-if="editSpeaker" class="absolute z-30 bg-white w-11/12 xs:w-full h-auto md:max-w-md mx-auto rounded shadow-lg pb-3 xs:pt-6 text-left p-4 px-6">
              <!--Title-->
                    <div class="flex justify-between items-center pb-3">
                        <p class="text-2xl font-bold">Add speaker(s)</p>
                        <div class="cursor-pointer z-50" @click="editSpeaker = false">
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
     </div>
</template>

<script>

const MAX_SIZE = 1000000;
const MAX_WIDTH = 720;
const MAX_HEIGHT = 720;
import EventBus from '../../event-bus'
export default {
    props: ['openSpeakers', 'speakers'],
    data() {
        return {
            image:{
                    size:'',
                    height:'',
                    width:''
                },
            editSpeaker: false,
            inviteLink: '',
            speakerFileUrl: null,
            speakerFileError: '',
            speakerImage: null,
            speakerId: null,
            errors: [],
            speaker:{
                facebook: '',
                twitter: '',
                linkedIn: '',
                name: '',
                email: '',
                organization: '',
                title: ''
            },
            addingSpeaker:false
        }
    },
    methods:{
        close(event){
          let payload = {'action': false,}
         EventBus.$emit('closeSpeakers', payload)
            console.log('emitted')
        },

        edit(item){
            this.speaker = item
            this.speakerId = item.id
            this.speakerFileUrl = '/files/images?filename='+item.image
           this.inviteLink = this.baseurl+'/invite/'+item.invite_id
            this.editSpeaker = true
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
            if (!this.speakerFileUrl || this.speakerFileError) {
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
            formdata.append('speakerId', this.speakerId)
            formdata.append('image', this.speakerImage)
            formdata.append('title', this.speaker.title)
            formdata.append('name', this.speaker.name)
            formdata.append('facebook', this.speaker.facebook)
            formdata.append('twitter', this.speaker.twitter)
            formdata.append('linkedin', this.speaker.linkedIn)
            formdata.append('organization', this.speaker.organization)
            formdata.append('email', this.speaker.email)

        let vm = this
        axios.post( '/api/updatespeaker',
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
            text: 'Speaker Updated',
            type: 'success',
             duration: 10000,
            });
           vm.editSpeaker = false
           vm.addingSpeaker = false

        })
        .catch(function(e){
           vm.addingSpeaker = false
            vm.$notify({
                type: 'warn',
                text: 'unable to update speaker'
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
