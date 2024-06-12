<template>
    <div>
        <nav-bar></nav-bar>

        <div class="min-h-[100vh] w-screen flex flex-col justify-start items-center">
            
            <div class="w-full flex flex-row justify-center items-center py-14">
                <h1 class="text-3xl font-bold text-orange-500 uppercase">{{ title }}</h1>
            </div>
            
            <div class="w-10/12 flex flex-col justify-center items-center py-14">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
import NavBar from './NavBar.vue'

export default {
    props:{
        title: {
            type: String,
            required: true,
            default: "Home",
        }
    },
    components: {
        NavBar
    },
}
</script>
