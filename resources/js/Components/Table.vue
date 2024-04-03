<script setup>
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    pagination: {
        type: Object,
        default: {
            enable: false,
            links: [],
            preserveState: false,
        },
    },
    columns: {
        type: Array,
        default: [],
    },
    data: {
        type: Array,
        default: [],
    },
    rowClasses: {
        type: String,
        default: "",
    },
    handleRowClick: {
        type: Function,
    },
});
</script>

<template>
    <div class="bg-white rounded overflow-x-auto">
        <table class="w-full whitespace-no-wrap table-fixed">
            <tr class="text-left font-bold">
                <slot name="thead">
                    <th
                        class="bg-gray-100 text-sm font-medium text-gray-700 py-4 px-2"
                        v-for="column in columns"
                        :class="column.styleClass"
                    >
                        {{ column.label }}
                    </th>
                </slot>
            </tr>
            <slot name="tbody">
                <tr
                    class="border-b"
                    :class="[
                        handleRowClick && 'hover:bg-gray-100 cursor-pointer',
                        rowClasses,
                    ]"
                    v-for="(item, index) in data"
                    :key="index"
                    @click="() => handleRowClick && handleRowClick(item)"
                >
                    <td
                        v-for="(column, colIndex) in columns"
                        :key="colIndex"
                        class="py-4 px-2"
                        :class="column.styleClass"
                    >
                        <component
                            :is="item[column.key]"
                            v-if="typeof item[column.key] !== 'string'"
                            :props="item.props"
                        />
                        <span v-else>{{ item[column.key] }}</span>
                    </td>
                </tr>
            </slot>
            <slot name="tfoot"></slot>
        </table>
    </div>
    <Pagination
        v-if="pagination.enable"
        :links="pagination.links"
        :preserve-state="pagination.preserveState"
    />
</template>
