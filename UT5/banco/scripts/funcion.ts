export const invoke = (name: string, workId: number, id: string, params: any = undefined) => {
    const url = `/api/modules/${name}/${workId}/invoke/${id}`;
    return fetch(url, {
        method: 'POST',
        body: JSON.stringify(params ?? {}),
        headers: {
            'Content-Type': 'plain/text'
        }
    });
}