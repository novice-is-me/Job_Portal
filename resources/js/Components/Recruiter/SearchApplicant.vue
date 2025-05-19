<script setup>
import {
    InputText,
    Select,
    InputGroup,
    InputGroupAddon,
    Button,
} from "primevue";

const clearInput = () => {};
</script>

<template>
    <div class="grid grid-cols-[3fr,2fr,1fr] gap-x-4 w-full">
        <div>
            <InputGroup>
                <InputGroupAddon>
                    <i class="pi pi-search"></i>
                </InputGroupAddon>
                <InputText placeholder="Job Name" class="w-full mb-4" />
            </InputGroup>
        </div>
        <div>
            <Select optionLabel="name" placeholder="Status" class="w-full" />
        </div>
        <div>
            <Button @click="clearInput">Clear Input</Button>
        </div>
    </div>
</template>
