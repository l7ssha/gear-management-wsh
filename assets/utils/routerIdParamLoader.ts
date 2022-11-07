export async function routerIdParamLoader({params}: any): Promise<string> {
    return params.id;
}
