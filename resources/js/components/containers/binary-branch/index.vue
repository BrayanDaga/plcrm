<template>
    <div>
        <Branch></Branch>
        <BinaryBranchTable></BinaryBranchTable>
    </div>
</template>

<script>
import BinaryBranchTable from './components/BinaryBranchTable';
import Branch from './components/Branch';
export default {
    name: 'BinaryBranch',
    components: { Branch, BinaryBranchTable }
};
</script>

<style scoped></style>
