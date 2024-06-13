<template>
    <page-template :title="getPageTitle">
        <form @submit.prevent="submit()" class="w-full min-h-[50vh] flex flex-col justify-center items-center">
            <div class="w-8/12 py-6 flex flex-col justify-center items-center bg-gray-100 shadow-md border border-gray-600 rounded-md">
                <div class="w-full grid grid-cols-12 place-content-center place-items-center gap-y-10">
                    <div class="col-span-12 lg:col-span-6 w-8/12 flex justify-start items-center text-left flex-wrap">
                        <label for="animal_id" class="text-default-gray font-bold text-lg">Select Animal <span class="text-xl text-red-600 font-bold">*</span></label>
                        <select v-model="adoption.animal_id" class="default-input" name="animal_id" id="animal_id" required>
                            <option value="" selected>Select animal...</option>
                            <option v-for="(animal, index) in animalsOptions" :key="index" :value="animal.id">{{ animal.name }}</option>
                        </select>
                    </div>

                    <div class="col-span-12 lg:col-span-6 w-8/12 flex justify-start items-center text-left flex-wrap">
                        <label for="person_id" class="text-default-gray font-bold text-lg">Select Person <span class="text-xl text-red-600 font-bold">*</span></label>
                        <select v-model="adoption.person_id" class="default-input" name="person_id" id="animal_id" required>
                            <option value="" selected>Select person...</option>
                            <option v-for="(person, index) in peopleOptions" :key="index" :value="person.id">{{ person.name }}</option>
                        </select>
                    </div>

                    <div class="col-span-12 lg:col-span-6 w-8/12 flex justify-start items-center text-left flex-wrap">
                        <label for="adoption-status" class="text-default-gray font-bold text-lg">Select Adoption Status <span class="text-xl text-red-600 font-bold">*</span></label>
                        <select v-model="adoption.adoption_status" class="default-input" name="adoption-status" id="adoption-status" required>
                            <option value="" selected>Select adoption's adoption status...</option>
                            <option v-for="(status, index) in adoptionsStatusOptions" :key="index" :value="status.key">{{ status.label }}</option>
                        </select>
                    </div>

                    <div class="col-span-12 lg:col-span-6 w-8/12 flex justify-start items-center text-left flex-wrap">
                        <label for="adoption-date" class="text-default-gray font-bold text-lg">Select Adoption Date <span class="text-xl text-red-600 font-bold">*</span></label>
                        <input v-model="adoption.adoption_date" type="date" name="adoption-date" id="adoption-date" class="default-input" required>
                    </div>

                    <div class="col-span-12 w-8/12 flex justify-start items-center text-left flex-wrap">
                        <label for="description" class="text-default-gray font-bold text-lg">Description <span class="text-xl text-red-600 font-bold">*</span></label>
                        <textarea v-model="adoption.description" name="description" id="description" placeholder="Type description..." class="default-input resize-none" required></textarea>
                    </div>

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

export default {
    beforeMount() {
        if(this.$route.params.id) {
            this.getAdoption();
        }

        this.getFormSelectOptions();
    },
    
    components: {
        PageTemplate
    },

    computed: {
        getPageTitle() {
            return this.adoption.id ? `Edit ${this.adoption.id}` : 'Create adoption';
        },
    },
    data() {
        return {
            headers: {
                'Content-Type': "application/json;",
                'Accept': "application/json;"
            },
            adoption: {
                id: '',
                animal_id: '',
                person_id: '',
                status: '',
                adoption_date: '',
                observation: '',
            },
            errors: [],
            adoptionsStatusOptions: [],
            animalsOptions: [],
            peopleOptions: []
        }
    },
    methods: {
        async getAdoption() {
            await axios.get(`http://localhost/api/adoptions/${this.$route.params.id}`)
                .then((response) => {
                    this.adoption.id = response.data.id;
                    this.adoption.animal_id = response.data.animal_id;
                    this.adoption.person_id = response.data.person_id;
                    this.adoption.status = response.data.status;
                    this.adoption.adoption_date = response.data.adoption_date;
                    this.adoption.observation = response.data.observation;
                })
                .catch(error => console.log(error));
        },

        async getFormSelectOptions() {
            await axios.get(`http://localhost/api/adoptions/get-form-select-options`)
                .then((response) => {
                    console.log(response.data);
                    this.adoptionsStatusOptions = response.data['adoptionsStatusOptions']
                    this.peopleOptions = response.data['peopleOptions']
                    this.animalsOptions = response.data['animalsOptions']
                })
                .catch(error => console.log(error));
        },

        async update() {
            await axios.put(`http://localhost/api/adoptions/${this.adoption.id}`, {
                    "id": this.adoption.id,
                    "animal_id": this.adoption.animal_id,
                    "person_id": this.adoption.person_id,
                    "status": this.adoption.status,
                    "adoption_date": this.adoption.adoption_date,
                    "observation": this.adoption.observation,
                }, { headers: this.headers })
                .then(response => {
                    if(response) {
                        this.$router.push({ name: "adoptions" })
                    }

                    this.error.push("An error occurred trying to UPDATE Adoption. Please reload the page!");
                })
                .catch(error => console.log(error));
        },

        async save() {
            await axios.post("http://localhost/api/adoptions/", {
                "id": this.adoption.id,
                "animal_id": this.adoption.animal_id,
                "person_id": this.adoption.person_id,
                "status": this.adoption.status,
                "adoption_date": this.adoption.adoption_date,
                "observation": this.adoption.observation,
            }, { headers: this.headers })
            .then(response => {
                if(response) {
                    this.$router.push({ name: "adoptions" })
                }

                this.error.push("An error occurred trying to SAVE new Adoption. Please reload the page!");
            })
            .catch(error => console.log(error));
        },

        validation() {
            let validator = 0;
            this.errors = [];
            
            if(this.adoption.animal_id === "") {
                this.errors.push("The ANIMAL field are required.");
                validator++;
            }

            if(this.adoption.person_id === "") {
                this.errors.push("The PERSON field are required.");
                validator++;
            }

            if(this.adoption.status === "" || !(this.adoption.status.length >= 3 && this.adoption.status.length <= 20)) {
                this.errors.push("The ADOPTION STATUS field are required and must be at least 3 characters and max of 20.");
                validator++;
            }

            if(this.adoption.adoption_date === "") {
                this.errors.push("The ADOPTION DATE field are required.");
                validator++;
            }

            return validator == 0 ?? false;
        },
        
        submit() {
            if(this.validation()) {
                if(this.$route.params.id) {
                    this.update();
                } else {
                    this.save();
                }
            }
        },
    }
}

</script>
