<template>
    <page-template :title="getPageTitle">
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

                <div class="col-span-12 w-6/12 flex justify-center items-center text-left">
                    <button class="w-full default-button">Save</button>
                </div>
            </div>
        </div>
    </page-template>
</template>

<script>
import PageTemplate from "../../components/PageTemplate.vue"

export default {
    beforeMount() {
        // if(this.$route.params.id) {
        //     this.getAnimal();
        // }
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
            adoption: {
                id: '',
                animal_id: '',
                person_id: '',
                status: '',
                adoption_date: '',
                observation: '',
            },
            adoptionsStatusOptions: [
                {
                    key: 'not_started',
                    label: 'Not started'
                },
                {
                    key: 'processing',
                    label: 'Processing'
                },
                {
                    key: 'accepted',
                    label: 'Accepted'
                },
                {
                    key: 'not_accepted',
                    label: 'Not accepted'
                },
            ],
            animalsOptions: [
                {
                    id: 1,
                    name: 'Doguinho'
                },
                {
                    id: 2,
                    name: 'Car'
                },
            ],
            peopleOptions: [
                {
                    id: 1,
                    name: 'User 1'
                },
                {
                    id: 2,
                    name: 'User 2'
                },
            ]
        }
    },
    
}

</script>
