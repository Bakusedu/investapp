<template>
  <div class="flex-col absolute overflow-x-auto shadow-2xl z-10 left-0" v-if="showUsers == true">
       <div class="text-lg font-bold"><span><i class="fa fa-calendar-alt"></i>Participants</span>
       </div>
      <div class="absolute" style="right:40px; top: 10px;">
          <span class="bg-red-700 px-2 py-1 cursor-pointer rounded-full text-white" @click="close">Close</span>
      </div>
     <div class="table shadow-2xl w-full">
        <div class="table-header-group border">
            <div class="table-row table-caption font-bold">
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm">Name</div>
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm">Picture</div>
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm">Email</div>
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm">Phone</div>
            </div>
        </div>
        <div class="table-row-group">
            <div class="table-row" v-for="(item,index) in userList" :key="index">
                <div class="table-cell bg-gray-200 text-gray-700 px-4 py-2 text-sm">{{item.first_name}} {{item.last_name}}</div>
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm">
                    <img :src="'/files/images?filename='+item.avatar" class="w-16 h-16 object-center" alt="">
                </div>
                <div class="table-cell bg-gray-200 text-gray-700 px-4 py-2 text-sm">{{item.email}}</div>
                <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm">{{item.phone}}</div>
            </div>
        </div>
     </div>
     </div>
</template>

<script>
import EventBus from '../../event-bus'
export default {
    props: ['showUsers', 'userList'],
    methods:{
        close(event){
          let payload = {'action': false,}
         EventBus.$emit('closeUsers', payload)
            console.log('emitted')
        },
    },
}
</script>

<style>

</style>
