<script setup>
import { useItemFormat } from "@/Composable/format";
import { errorNotification, successNotification } from '@/Composable/notification';
import {
    PencilSquareIcon,
    TrashIcon
} from "@heroicons/vue/24/outline";
import { router, useForm, usePage } from "@inertiajs/vue3";
import { ref } from "vue";
import CustomModal from "./CustomModal.vue";
import FilterDropdown from "./FilterDropdown.vue";


const props = defineProps({
    video: Object,
    categories: Array,
    
});


const page = usePage();
const form = useForm({
    name: props.video?.name || "",
    description: props.video?.description || "",
    quantity: props.video?.quantity || "",
    image: "",
    inventory_id: props.video?.inventory_id || null,
    _method: 'PUT'
});

const showEditModal = ref(false);
const showDeleteModal = ref(false);



const handleFileChange = (e) => {
    form.image = e.target.files[0];
};
const errors = ref("");

const getDefaultCategoryIndex = () => {
    // Find the index of the category with the same id as video's inventory_id
    const defaultCategoryIndex = props.categories.findIndex(category => category.id === props.video?.inventory_id);
    
    // Return the index
    return defaultCategoryIndex !== -1 ? defaultCategoryIndex : 0; // If not found, return 0 or any default index you prefer
}


const allCategory = [...props.categories];
const getSelectedCategory = (selectedCategoryName) => {

    const selectedCategory = allCategory.find(category => category.name === selectedCategoryName);

    // If selectedCategory is found, set its id to form.inventory_id
    if (selectedCategory) {
        form.inventory_id = selectedCategory.id;
    }
}

const handleUpdate = (input) => {
        
    router.post(
        route("items:update", input.slug),
        useItemFormat(form.data()),
        {
            onSuccess: () => {
                showEditModal.value = false;
                form.reset();
                successNotification("Item Updated Successfully");
            },
            onError: (e) => {
                errors.value = e;
                errorNotification("Something went wrong!");
            }
            
        }
    );
};


const handleDelete = (data) => {
    router.delete(route("items:destroy", data.slug), {

        onSuccess: () => {
            showDeleteModal.value = false;
            form.reset();
            successNotification("Item Deleted Successfully");
        },
            onError: (errors) => {
                errorNotification("Something went wrong!");
            }
    });
};

</script>

<template>
    <td
        class="flex flex-col sm:flex-row gap-x-2 py-1 lg:gap-x-4 lg:py-4 px-2 items-center lg:px-4 group"
    >
        <div
            class="relative min-w-[150px] max-w-[150px] aspect-[3/2] transition-all duration-500 group-hover:scale-110 cursor-pointer"
        >
            <img
                :src="video.image"
                class="w-full h-full rounded-lg object-cover object-center"
            />

        </div>
        <div class="text-left">
            <a
                href="#"
                class="text-sm md:text-base font-semibold text-gray-700"
            >
                {{ video.name }}
            </a>
        </div>
    </td>
    <td class="table-text-style">
        {{ video?.inventory?.name}}
    </td>
    <td class="table-text-style">
        {{ video.description}}
    </td>
    <td class="table-text-style">
        {{ video.quantity }}
    </td>
    <td class="text-end text-md">
        <div
            class="flex-col flex justify-center items-center gap-2"
        >
            <button class="btn-primary w-28 px-2"
            @click="showEditModal = true"
            >
                <div class="flex justify-center items-center w-full">
                    <PencilSquareIcon class="h-5 w-5 text-white mr-1"
                    />
                    Edit
                </div>
            </button>
            <button class="btn-danger px-2 w-28"
            @click="showDeleteModal = true"
            >
                <div class="flex justify-center items-center w-full">
                    <TrashIcon class="h-5 w-5 text-white mr-1" />
                    Delete
                </div>
            </button>
        </div>

    </td>

    <CustomModal
        :open="showDeleteModal"
        :title="`Do you want to delete this item?`"
    >
        <template #body>
            <div class="flex justify-center gap-3">
                <button
                    @click="showDeleteModal = false"
                    class="btn-primary bg-red-500"
                >
                    No
                </button>

                <button
                    @click="handleDelete(video)"
                    class="btn-primary mr-2"
                >
                    Yes
                </button>
            </div>
        </template>
    </CustomModal>

    <CustomModal :open="showEditModal">
        <template #body>
            <FilterDropdown
                    class="text-sm"
                    :drop-down-data="allCategory"
                    :default="getDefaultCategoryIndex()"
                    @getFilterData="getSelectedCategory"
                />
            <div>
                <input type="text" name="name" id="tag" class="border my-4 border-gray-400 rounded-md w-full p-2"
                    v-model="form.name" placeholder="Type your item name" />
            </div>
            <div class="text-xs text-red-500">
                <p v-if="errors.name" class="text-center mb-4" v-text="errors.name"></p>
            </div>
            <div>
                <textarea type="text" name="name" id="tag" class="border my-4 border-gray-400 rounded-md w-full p-2"
                    v-model="form.description" placeholder="Type your description" />
            </div>
            <div class="text-xs text-red-500">
                <p v-if="errors.description" class="text-center mb-4" v-text="errors.description"></p>
            </div>
            <div>
                <input type="number" name="name" id="tag" class="border my-4 border-gray-400 rounded-md w-full p-2"
                    v-model="form.quantity" placeholder="Type your quantity" />
            </div>
            <div class="text-xs text-red-500">
                <p v-if="errors.quantity" class="text-center mb-4" v-text="errors.quantity"></p>
            </div>
            <div>
                <input type="file" @change="handleFileChange" class="border my-4 border-gray-400 rounded-md w-full p-2"/>
            </div>
            <div class="text-xs text-red-500">
                <p v-if="errors.image" class="text-center mb-4" v-text="errors.image"></p>
            </div>
            
            <div class="flex justify-center gap-3">
                <button
                    @click="showEditModal = false"
                    class="btn-primary bg-red-500"
                >
                    Close
                </button>

                <button
                    @click="handleUpdate(video)"
                    class="btn-primary"
                >
                    Confirm
                </button>
            </div>
        </template>
    </CustomModal>

</template>
