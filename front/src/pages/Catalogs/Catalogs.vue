<template>
    <page-template title="Catalogs">

        <div class="w-8/12 flex flex-row justify-start items-center">
            <router-link to="/catalogs/create" class="default-button mb-5">Create new Catalog</router-link>
            <button class="default-button mb-5">See table view</button>
        </div>
        
        <div class="w-8/12 flex flex-row justify-center items-center gap-4 flex-wrap">
            <router-link to="/catalogs/detail/1" class="bg-catalog-card">
                <h2>See catalog 1</h2>
            </router-link>
        </div>
    </page-template>
</template>

<script>
import PageTemplate from "../../components/PageTemplate.vue"

export default {
    components: {
        PageTemplate
    },
}
</script>
