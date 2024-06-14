<template>
    <page-template title="Create new User">
        <form @submit.prevent="submit()" class="w-full min-h-[50vh] flex flex-col justify-center items-center">
            <div class="w-8/12 py-6 flex flex-col justify-center items-center bg-gray-100 shadow-md border border-gray-600 rounded-md">
                <div class="w-full grid grid-cols-12 place-content-center place-items-center gap-y-10">
                    <div class="col-span-12 lg:col-span-6 w-8/12 flex justify-start items-center text-left flex-wrap">
                        <label for="name" class="text-default-gray font-bold text-lg">Name <span class="text-xl text-red-600 font-bold">*</span></label>
                        <input v-model="user.name" type="text" name="name" id="name" placeholder="Type your name..." class="default-input" required>
                    </div>

                    <div class="col-span-12 lg:col-span-6 w-8/12 flex justify-start items-center text-left flex-wrap">
                        <label for="email" class="text-default-gray font-bold text-lg">Email <span class="text-xl text-red-600 font-bold">*</span></label>
                        <input v-model="user.email" type="email" name="email" id="email" placeholder="Type your email..." class="default-input" required>
                    </div>

                    <div class="col-span-12 lg:col-span-6 w-8/12 flex justify-start items-center text-left flex-wrap">
                        <label for="cpf" class="text-default-gray font-bold text-lg">CPF (numbers only) <span class="text-xl text-red-600 font-bold">*</span></label>
                        <input v-model="user.cpf" type="text" name="cpf" id="cpf" placeholder="Type your CPF..." class="default-input" required>
                    </div>

                    <div class="col-span-12 lg:col-span-6 w-8/12 flex justify-start items-center text-left flex-wrap">
                        <label for="birth-date" class="text-default-gray font-bold text-lg">Birth Date <span class="text-xl text-red-600 font-bold">*</span></label>
                        <input v-model="user.birth_date" type="date" name="birth-date" id="birth-date" class="default-input">
                    </div>

                    <div class="col-span-12 lg:col-span-6 w-8/12 flex justify-start items-center text-left flex-wrap">
                        <label for="password" class="text-default-gray font-bold text-lg">Password <span class="text-xl text-red-600 font-bold">*</span></label>
                        <input v-model="user.password" type="password" name="password" id="password" placeholder="Type your password..." class="default-input" required>
                    </div>

                    <div class="col-span-12 lg:col-span-6 w-8/12 flex justify-start items-center text-left flex-wrap">
                        <label for="password_confirmation" class="text-default-gray font-bold text-lg">Confirm password <span class="text-xl text-red-600 font-bold">*</span></label>
                        <input v-model="user.password_confirmation" type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm your password..." class="default-input" required>
                    </div>

                    <phone-info :phones="user.phones" @update-phone="updatePhone"></phone-info>

                    <address-info :addresses="user.addresses" @update-address="updateAddress"></address-info>

                    <div v-show="errors.length > 0" class="col-span-12 flex flex-col justify-start items-start text-left">
                        <span v-for="(error, index) in errors" :key="index" class="text-red-500 font-semibold">{{ error }}</span>
                    </div>

                    <div class="col-span-12 w-6/12 flex justify-center items-center text-left">
                        <button type="submit" class="w-full default-button">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </page-template>
</template>

<script>
import axios from 'axios';
import PageTemplate from "../../components/PageTemplate.vue"
import PhoneInfo from '../../components/PhoneInfo.vue';
import AddressInfo from '../../components/AddressInfo.vue';

export default {
    components: {
        PageTemplate,
        PhoneInfo,
        AddressInfo
    },

    data() {
        return {
            headers: {
                'Content-Type': "application/json;",
                'Accept': "application/json;"
            },
            errors: [],
            user: {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                cpf: '',
                birth_date: '',
                phones: [],
                addresses: [],
            },
        }
    },
    
    methods: {
        async save() {
            await axios.post("http://localhost/api/users/", {
                "name": this.user.name,
                "email": this.user.email,
                "password": this.user.password,
                "password_confirmation": this.user.password_confirmation,
                "cpf": this.user.cpf,
                "birth_date": this.user.birth_date,
                "phones": this.user.phones,
                "addresses": this.user.addresses,
            }, { headers: this.headers })
            .then(response => {
                console.log(`Showing response ${response}`);
                if(response) {
                    this.$router.push({ name: "users" })
                }

                this.error.push("An error occurred trying to SAVE new User. Please reload the page!");
            })
            .catch(error => console.log(error));
        },

        validation() {
            let validator = 0;
            this.errors = [];
            
            if(this.user.name === "" || !(this.user.name.length >= 3 && this.user.name.length <= 60)) {
                this.errors.push("The NAME field are required and must be at least 3 characters and max of 60.");
                validator++;
            }

            if(this.user.email === "" || !(this.user.email.length >= 3 && this.user.email.length <= 60)) {
                this.errors.push("The EMAIL field are required and must be valid.");
                validator++;
            }
            
            if(this.user.password === "" || this.user.password.length < 8) {
                this.errors.push("The PASSWORD field are required and must be at least 8 characters.");
                validator++;
            }

            if(this.user.password_confirmation === "" || this.user.password_confirmation.length < 8 || this.user.password_confirmation.trim() !== this.user.password.trim()) {
                this.errors.push("The CONFIRM PASSWORD field are required, must be at least 8 characters and needs to be equal PASSWORD");
                validator++;
            }

            if(this.user.cpf === "" || this.user.cpf.length !== 11) {
                this.errors.push("The CPF field are required and must be 11 characters (exclude '.' and '-').");
                validator++;
            }

            if(this.user.birth_date === "") {
                this.errors.push("The BIRTH DATE field are required.");
                validator++;
            }

            if(this.user.phones.length <= 0) {
                this.errors.push("At least one valid PHONE are required.");
                validator++;
            }

             if(this.user.addresses.length <= 0) {
                this.errors.push("At least one valid ADDRESS are required.");
                validator++;
            }

            return validator == 0 ?? false;
        },

        updatePhone(newPhones) {
            this.user.phones = newPhones;
        },

        updateAddress(newAddresses) {
            this.user.addresses = newAddresses;
        },

        submit() {
            if(this.validation()) {
                this.save();
            }
        },
    }
    
}

</script>