<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { nextTick, onBeforeMount, onMounted, reactive, ref } from "vue";
// import { Head, Link, router, usePage } from '@inertiajs/vue3';
import ReturnButton from "@/Components/ReturnButton.vue";
import { Head, router, usePage } from "@inertiajs/vue3";
import { DocumentEditor } from "@onlyoffice/document-editor-vue";
import axios from "axios";

const prop = defineProps({
    document: Object,
    media: Object,
    // token: String
});

// properties
const docEditor = ref(null);

// webix
const inertia = usePage();

const header = {
    "X-CSRF-TOKEN": inertia.props.csrf,
};

const functionInit = (evt) => {};

const config = reactive({
    document: {
        fileType: "docx",
        title: prop?.document?.title,
        url: prop?.media?.original_url,
        permissions: {
            download: true,
            edit: true,
        },
    },
    // token: prop.token,
    documentType: "word",
    editorConfig: {
        callbackUrl: route("only.document", {
            document: prop.document,
            documentId: prop?.media?.id,
            fileName: prop?.media?.file_name,
        }),
        customization: {
            forcesave: true,
            autosave: false
        }
    },
});

// methods

</script>

<template>
    <Head title="DOCUMENTO APERTO" />

    <AuthenticatedLayout
        content="px-0 h-full grow w-full max-w-full xl:max-w-full xl:mx-none xl:px-0 flex flex-col"
    >
        <template #green-bar-button-right>
            <ReturnButton buttonSize="buttonSm" />
        </template>
        <div class="relative h-full pt-0" style="height: calc(100vh - 3.05rem)">
            <div class="relative h-full overflow-hidden" v-if="config">
                <!-- documentServerUrl="https://costruzionidibrennero.it/" -->
                <!-- documentServerUrl="http://192.168.0.3:82/" -->
                <DocumentEditor
                    class="w-full h-full"
                    ref="docEditor"
                    id="docker"
                    :documentServerUrl="inertia.props.docserver"
                    :config="config"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
