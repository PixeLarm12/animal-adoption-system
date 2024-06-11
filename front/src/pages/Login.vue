<template>
    <div class="min-h-[100vh] w-screen flex flex-col justify-center items-center">
        <div class="w-7/12 h-[60vh] flex flex-col justify-center items-center bg-gray-100 shadow-md border border-gray-600 rounded-md">
            <div class="w-full h-full grid grid-cols-12 place-content-center place-items-center gap-y-10">
                <div class="col-span-12 w-5/12 flex justify-start items-center text-left flex-wrap">
                    <label for="email" class="text-default-gray font-bold text-lg">Email</label>
                    <input v-model="email" type="email" name="email" id="email" placeholder="Type your email..." class="default-input">
                </div>

                <div class="col-span-12 w-5/12 flex justify-start items-center text-left flex-wrap">
                    <label for="password" class="text-default-gray font-bold text-lg">Password</label>
                    <input v-model="password" type="password" name="password" id="password" placeholder="Type your password..." class="default-input">
                </div>

                <div class="col-span-12 w-5/12 flex justify-center items-center text-left">
                    <button class="w-full default-button">login</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            email: '',
            password: '',
        }
    },
}
</script>
