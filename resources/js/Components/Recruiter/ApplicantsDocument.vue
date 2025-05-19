<script setup>
import { ref } from "vue";
import PDFViewer from "../PDFViewer.vue";

const props = defineProps({
    applicant: Object,
});

const isCoverLetterView = ref(false);
const isResumeView = ref(false);

// Store type per document (pdf, image, null)
const documentType = ref({
    resume: null,
    cover_letter: null,
});

const baseURL = "http://127.0.0.1:8000"; // or your API base URL

const getFullURL = (path) => {
    if (!path.startsWith("http")) {
        return baseURL + path;
    }
    return path;
};

// Determine file type and store per document
const fileExtension = (fileName, type) => {
    const ext = fileName.split(".").pop().toLowerCase();
    if (["jpg", "jpeg", "png"].includes(ext)) {
        documentType.value[type] = "image";
    } else if (["pdf", "docx", "doc"].includes(ext)) {
        documentType.value[type] = "pdf";
    } else {
        documentType.value[type] = null;
    }

    console.log("File extension check:", documentType.value);
};

// View document
const viewDocument = (document) => {
    console.log("Viewing document:", document);

    if (document.includes("cover_letter")) {
        isCoverLetterView.value = !isCoverLetterView.value;
        fileExtension(document, "cover_letter");
    } else if (document.includes("resume")) {
        isResumeView.value = !isResumeView.value;
        fileExtension(document, "resume");
    }
};

// Download document
const downloadDocument = (filePath) => {
    const link = document.createElement("a");
    link.href = getFullURL(`/storage/${filePath}`);
    link.download = filePath.split("/").pop(); // Optional: suggests filename
    link.target = "_blank"; // Optional: opens in new tab
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
};
</script>

<template>
    <div>
        <!-- Resume -->
        <div>
            <div v-if="applicant.resume">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-x-2">
                        <i class="pi pi-file text-blue-500"></i>
                        <p class="font-semibold text-lg">Resume</p>
                    </div>
                    <div class="flex items-center gap-x-4">
                        <i
                            @click="viewDocument(applicant.resume)"
                            class="pi pi-eye text-blue text-blue-500 border p-2 rounded-md hover:cursor-pointer"
                        ></i>
                        <i
                            @click="downloadDocument(applicant.resume)"
                            class="pi pi-download text-blue text-blue-500 border p-2 rounded-md hover:cursor-pointer"
                        ></i>
                    </div>
                </div>

                <!-- Actual Resume -->
                <div v-if="isResumeView">
                    <div
                        v-if="documentType.resume === 'image'"
                        class="flex justify-center p-2"
                    >
                        <img
                            :src="`/storage/${applicant.resume}`"
                            alt="Resume"
                            class="w-full h-auto"
                        />
                    </div>
                    <div
                        v-else-if="documentType.resume === 'pdf'"
                        class="w-full max-w-[600px] h-[600px] overflow-auto mx-auto p-4 md:p-0"
                    >
                        <PDFViewer
                            :src="`http://127.0.0.1:8000/storage/${applicant.resume}`"
                        />
                    </div>
                </div>
            </div>
            <div v-else>
                <p class="text-secondary text-sm">No documents uploaded yet.</p>
            </div>
        </div>

        <!-- Cover Letter -->
        <div class="mt-6">
            <div v-if="applicant.cover_letter">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-x-2">
                        <i class="pi pi-file text-blue-500"></i>
                        <p class="font-semibold text-lg">Cover Letter</p>
                    </div>
                    <div class="flex items-center gap-x-4">
                        <i
                            @click="viewDocument(applicant.cover_letter)"
                            class="pi pi-eye text-blue text-blue-500 border p-2 rounded-md hover:cursor-pointer"
                        ></i>
                        <i
                            @click="downloadDocument(applicant.cover_letter)"
                            class="pi pi-download text-blue text-blue-500 border p-2 rounded-md hover:cursor-pointer"
                        ></i>
                    </div>
                </div>

                <!-- Actual Cover Letter -->
                <div v-if="isCoverLetterView">
                    <div
                        v-if="documentType.cover_letter === 'image'"
                        class="flex justify-center p-2"
                    >
                        <img
                            :src="`/storage/${applicant.cover_letter}`"
                            alt="Cover Letter"
                            class="w-[50%] h-auto"
                        />
                    </div>
                    <div
                        v-else-if="documentType.cover_letter === 'pdf'"
                        class="w-full max-w-[600px] h-[600px] overflow-auto mx-auto p-4 md:p-0"
                    >
                        <PDFViewer
                            :src="`http://127.0.0.1:8000/storage/${applicant.cover_letter}`"
                        />
                    </div>
                </div>
            </div>
            <div v-else>
                <p class="text-secondary text-sm">No documents uploaded yet.</p>
            </div>
        </div>
    </div>
</template>
