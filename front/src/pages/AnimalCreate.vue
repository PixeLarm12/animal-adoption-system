<template>
    <page-template title="Create new Animal">
        <div class="w-8/12 py-6 flex flex-col justify-center items-center bg-gray-100 shadow-md border border-gray-600 rounded-md">
            <div class="w-full grid grid-cols-12 place-content-center place-items-center gap-y-10">
                <div class="col-span-12 lg:col-span-6 w-8/12 flex justify-start items-center text-left flex-wrap">
                    <label for="name" class="text-default-gray font-bold text-lg">Name <span class="text-xl text-red-600 font-bold">*</span></label>
                    <input v-model="animal.name" type="name" name="name" id="name" placeholder="Type animal's name..." class="default-input" required>
                </div>

                <div class="col-span-12 lg:col-span-6 w-8/12 flex justify-start items-center text-left flex-wrap">
                    <label for="sex" class="text-default-gray font-bold text-lg">Select Sex <span class="text-xl text-red-600 font-bold">*</span></label>
                    <select v-model="animal.sex" class="default-input" name="sex" id="sex" required>
                        <option value="m" selected>Male</option>
                        <option value="f">Female</option>
                    </select>
                </div>

                <div class="col-span-12 lg:col-span-6 w-8/12 flex justify-start items-center text-left flex-wrap">
                    <label for="specie" class="text-default-gray font-bold text-lg">Select Specie <span class="text-xl text-red-600 font-bold">*</span></label>
                    <select v-model="animal.specie" class="default-input" name="specie" id="specie" required>
                        <option value="" selected>Select animal's specie...</option>
                        <option v-for="(specie, index) in speciesOptions" :key="index" :value="specie.key">{{ specie.label }}</option>
                    </select>
                </div>

                <div class="col-span-12 lg:col-span-6 w-8/12 flex justify-start items-center text-left flex-wrap">
                    <label for="adoption-status" class="text-default-gray font-bold text-lg">Select Adoption Status <span class="text-xl text-red-600 font-bold">*</span></label>
                    <select v-model="animal.adoption_status" class="default-input" name="adoption-status" id="adoption-status" required>
                        <option value="" selected>Select animal's adoption status...</option>
                        <option v-for="(status, index) in adoptionsStatusOptions" :key="index" :value="status.key">{{ status.label }}</option>
                    </select>
                </div>

                <div class="col-span-12 lg:col-span-6 w-8/12 flex justify-start items-center text-left flex-wrap">
                    <label for="entry-date" class="text-default-gray font-bold text-lg">Select Entry Date <span class="text-xl text-red-600 font-bold">*</span></label>
                    <input v-model="animal.entry_date" type="date" name="entry-date" id="entry-date" class="default-input" required>
                </div>

                <div class="col-span-12 lg:col-span-6 w-8/12 flex justify-start items-center text-left flex-wrap">
                    <label for="birth-date" class="text-default-gray font-bold text-lg">Select Birth Date <span class="text-xl text-red-600 font-bold">*</span></label>
                    <input v-model="animal.birth_date" type="date" name="birth-date" id="birth-date" class="default-input" required>
                </div>

                <div class="col-span-12 w-6/12 flex justify-center items-center text-left">
                    <button class="w-full default-button">Save</button>
                </div>
            </div>
        </div>
    </page-template>
</template>

<script>
import PageTemplate from "../components/PageTemplate.vue"

export default {
    components: {
        PageTemplate
    },
    data() {
        return {
            animal: {
                adoption_status: '',
                name: '',
                specie: '',
                sex: '',
                description: '',
                entry_date: '',
                birth_date: '',
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
            speciesOptions: [
                {
                    key: 'dog',
                    label: 'Dog'
                },
                {
                    key: 'cat',
                    label: 'Cat'
                },
                {
                    key: 'bird',
                    label: 'Bird'
                },
                {
                    key: 'fish',
                    label: 'Fish'
                },
                {
                    key: 'lizard',
                    label: 'Lizard'
                },
            ],
        }
    }
}

</script>
