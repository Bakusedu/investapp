<template>
   <div v-if="view==true"  class="absolute bg-white transform origin-left ease-in-out duration-1000  right-0 flex-1 w-8/12 xs:w-full z-20 xs:m-0 xs:mt-5 m-3 p-6 flex rounded-lg">
        <div class="w-full flex xs:flex-col h-full flex-wrap rounded-lg">
            <div class="flex-1 flex flex-col h-auto p-3 justify-center items-center shadow-md">
                <div class="flex-none rounded-full h-56 w-56" :style="{backgroundImage:`url('/files/images?filename=${creator.avatar}')`, backgroundSize: 'cover',  backgroundRepeat: 'no-repeat', backgroundPosition: 'center'}"></div>
                <div class="flex-none text-lg font-bold">{{creator.first_name}} {{creator.last_name}}</div>
                <div class="flex-none font-bold"><span>Host</span></div>
                <div class="flex-none"><span class="text-gray-500"><i class="fa fa-envelope"></i>{{creator.email}}</span> </div>
            </div>
            <div v-for="(item,index) in facilitators" :key="index" class="flex-1 flex flex-col h-auto p-3 justify-center items-center shadow-md">
                <div class="flex-none rounded-full h-56 w-56" :style="{backgroundImage:`url('/files/images?filename=${item.image}')`, backgroundSize: 'cover',  backgroundRepeat: 'no-repeat', backgroundPosition: 'center'}"></div>
                <div class="flex-none text-lg font-bold">{{item.name}}</div>
                <div class="flex-none font-bold"><span>{{item.title}}</span>, {{item.organization}}</div>
                <div class="flex-none"><a :href="item.facebook"><span class="text-blue-800"><i class="fab fa-facebook-square"></i></span></a> <a :href="item.facebook"><span class="text-blue-600"><i class="fab fa-twitter-square"></i></span></a> <a :href="item.linkedIn"><span class="text-blue-600"><i class="fab fa-linkedin"></i></span></a></div>
            </div>
        </div>
        <a href="#" @click="close()" class="flex-1 float-left right-0 justify-end"><span class="px-3 py-2 rounded-full font-extrabold">X</span></a>
   </div>
</template>

<script>
export default {
    props: ['facilitators', 'view', 'creator'],
    methods: {
        close(event){
        this.$emit('close', true)
        },
    },

    mounted(){
    console.log(this.creator)
    }
}
</script>

<style>

</style>
