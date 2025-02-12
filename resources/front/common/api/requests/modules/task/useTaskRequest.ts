import {notify} from '@kyvg/vue3-notification';
import Qs from 'qs';
import useClient from '@/common/api/client';
import {taskRoute} from '@/common/api/task_routes';
import {NonPaginateLatestResponse, nonPaginateResponse,TaskRequestPayload, TaskWorkRequestPayload} from '@/common/parsers/TaskParser';


//all tasks
export async function useGetTasksRequest(options?: object):Promise<nonPaginateResponse>{
    const client = useClient();

    const cn = Qs.stringify(options, {arrayFormat: 'brackets'});
    return await client.get(taskRoute() + '?' + cn).json();
}
export async function useGetLatestTasksRequest(options?: object): Promise<NonPaginateLatestResponse> {
    const client = useClient();
    const cn = Qs.stringify(options, {arrayFormat: 'brackets'});
    return await client.get(taskRoute() + '/latest'+ '?' + cn).json();
}
export async function useGetAssignedTasksRequest(options?: object): Promise<NonPaginateLatestResponse> {
    const client = useClient();
    const cn = Qs.stringify(options, {arrayFormat: 'brackets'});
    return await client.get(taskRoute() + '/user'+ '?' + cn).json();
}



export async function useWorkTaskRequest(
    payload: TaskWorkRequestPayload, 
    task_id:string,
):Promise<nonPaginateResponse>{
    const client = useClient();

    // const cn = Qs.stringify(options, {arrayFormat: 'brackets'});
    const response = await client.post(taskRoute()+ '/work/'+ task_id,{
        json: payload,
    });
    return response.json();
}

export async function useUpdateWorkTaskRequest(
    payload: TaskWorkRequestPayload, 
    taskstatus_id:string,
):Promise<nonPaginateResponse>{
    const client = useClient();
    // const cn = Qs.stringify(options, {arrayFormat: 'brackets'});
    const response = await client.post(taskRoute()+ '/work/update/'+ taskstatus_id,{
        json: payload,
    });
    return response.json();
}

//board tasks
export async function useGetBoardTasksRequest(board_id:string, options?: object):Promise<nonPaginateResponse>{
    const client = useClient();
    const cn = Qs.stringify(options, {arrayFormat: 'brackets'});
    return await client.get(taskRoute()+ '/board/' + board_id + '?' + cn).json();
}

export async function useCreateBoardTaskRequest(
    payload: TaskRequestPayload, 
    boardid: string,
){
    const client = useClient();
    const response = await client.post(taskRoute() + '/board/create/' + boardid,{
        json: payload,
    });
    return response.json();
}

export async function useUpdateBoardTaskRequest(
    payload: TaskRequestPayload,  
    taskid:string,
){
    const client = useClient();
    const response = await 
    client.patch(taskRoute() + '/board/update/'+ taskid,{
        json: payload,
    });
    return response.json();
}

//committee tasks
export async function useGetCommitteeTasksRequest(
    committee_id:string, 
    options?: object,
):Promise<nonPaginateResponse>{
    const client = useClient();

    const cn = Qs.stringify(options, {arrayFormat: 'brackets'});
    return await client.get(taskRoute()+ '/committee/' + committee_id + '?' + cn).json();
}

export async function useCreateCommitteeTaskRequest(
    payload: TaskRequestPayload, 
    committeeid: string,
){
    const client = useClient();
    const response = await client.post(taskRoute() + '/committee/create/' + committeeid,{
        json: payload,
    });
    return response.json();
}

export async function useUpdateCommitteeTaskRequest(
    payload: TaskRequestPayload,  
    taskid:string,
){
    const client = useClient();
    const response = await 
    client.patch(taskRoute() + '/committee/update/'+ taskid,{
        json: payload,
    });
    return response.json();
}






//meetign tasks
export async function useGetMeetingTasksRequest(meeting_id:string, options?: object):Promise<nonPaginateResponse>{
    const client = useClient();

    const cn = Qs.stringify(options, {arrayFormat: 'brackets'});
    return await client.get(taskRoute()+ '/meeting/' + meeting_id + '?' + cn).json();
}

export async function useCreateMeetingTaskRequest(payload: TaskRequestPayload, meetingid: string){
    const client = useClient();
    const response = await client.post(taskRoute() + '/meeting/create/' + meetingid,{
        json: payload,
    });
    return response.json();
}

export async function useUpdateMeetingTaskRequest(
    payload: TaskRequestPayload, 
    meetingid: string,  
    taskid:string,
){
    const client = useClient();
    const response = await 
    client.patch(taskRoute() + '/meeting/update/' + meetingid +'/' + taskid,{
        json: payload,
    });
    return response.json();
}
export async function useUpdateTaskRequest(payload: TaskRequestPayload, meetingid: string){
    const client = useClient();
    const response = await client.patch(taskRoute() + '/meeting/update/' + meetingid ,{
        json: payload,
    });
    return response.json();
}



