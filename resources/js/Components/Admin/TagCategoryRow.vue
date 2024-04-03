<script setup>
import { PencilIcon, TrashIcon } from "@heroicons/vue/24/outline";
import { ref, defineProps } from "vue";
import { useForm } from "@inertiajs/vue3";
import CustomModal from "../CustomModal.vue";

const props = defineProps({
    data: {
        type: Object,
        required: true,
    },
    name: String,
    handleDelete: {
        type: Function,
        required: true,
    },
    handleEdit: {
        type: Function,
        required: true,
    },
    showDeleteModal: {
        type: Boolean,
        required: true,
    },
    showEditModal: {
        type: Boolean,
        required: true,
    },
    errors: {
        type: Object,
        default: () => { },
    },
});

const form = useForm({ name: props.data.name, description:  props.data.description});
</script>

<template>
    <tr class="hover:bg-gray-100 transition-colors group border-t border-gray-200">
        <td class="py-4 text-center px-2">{{ data.name }}</td>
         <td class="py-4 text-center px-2">{{ data.description  }}</td> 
        <td class="py-4 text-center">
            <div class="flex justify-center">
                <button
                    @click="showEditModal = true"
                    class="cursor-pointer m-1 pt-1"
                >
                    <PencilIcon class="h-4 w-4" />
                </button>
                <button
                    @click="showDeleteModal = true"
                    class="cursor-pointer m-1 pt-1"
                >
                    <TrashIcon class="h-4 w-4" />
                </button>
            </div>
        </td>
    </tr>

    <CustomModal
        :open="showDeleteModal"
        :title="`Do you want to delete this ${props.name}`"
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
                    @click="handleDelete(data)"
                    class="btn-primary mr-2"
                >
                    Yes
                </button>
            </div>
        </template>
    </CustomModal>

    <CustomModal :open="showEditModal">
        <template #body>
            <div>
                <label for="tag">Name</label>
                <input
                    type="text"
                    name="tag"
                    id="tag"
                    class="border my-4 border-gray-400 rounded-md w-full p-2"
                    v-model="form.name"
                />
            </div>
            <div class="text-xs text-red-500">
                <p v-if="errors?.name" class="text-center mb-4" v-text="errors?.name"></p>
            </div>
            <div>
                <label for="tag">Description</label>
                <textarea
                    type="text"
                    name="tag"
                    id="tag"
                    class="border my-4 border-gray-400 rounded-md w-full p-2"
                    v-model="form.description"
                />
            </div>
            <div class="text-xs text-red-500">
                <p v-if="errors?.description" class="text-center mb-4" v-text="errors?.description"></p>
            </div>
            <div class="flex justify-center gap-3">
                <button
                    @click="showEditModal = false"
                    class="btn-primary bg-red-500"
                >
                    Close
                </button>

                <button
                    @click="handleEdit(data, form)"
                    class="btn-primary"
                >
                    Confirm
                </button>
            </div>
        </template>
    </CustomModal>
</template>
