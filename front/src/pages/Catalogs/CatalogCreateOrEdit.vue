<template>
    <page-template :title="getPageTitle">
        <div class="w-8/12 py-6 flex flex-col justify-center items-center bg-gray-100 shadow-md border border-gray-600 rounded-md">
            <div class="w-full grid grid-cols-12 place-content-center place-items-center gap-y-10">
                <div class="col-span-12 w-8/12 flex justify-start items-center text-left flex-wrap">
                    <label for="title" class="text-default-gray font-bold text-lg">Title <span class="text-xl text-red-600 font-bold">*</span></label>
                    <input v-model="catalog.title" type="text" name="title" id="title" placeholder="Type catalog's title..." class="default-input" required>
                </div>

                <div class="col-span-12 w-8/12 flex justify-start items-center text-left flex-wrap">
                    <label for="title" class="text-default-gray font-bold text-lg">Description <span class="text-xl text-red-600 font-bold">*</span></label>
                    <textarea v-model="catalog.description" name="description" id="description" placeholder="Type catalog's description..." class="default-input-textarea" cols="30" rows="5" required></textarea>
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
        //     this.getCatalog();
        // }
    },
    components: {
        PageTemplate
    },
    computed: {
        getPageTitle() {
            return this.catalog.id ? `Edit ${this.catalog.title}` : 'Create catalog';
        },
    },
    data() {
        return {
            catalog: {
                id: '',
                title: '',
                description: '',
            },
        }
    },
    
}

</script>
