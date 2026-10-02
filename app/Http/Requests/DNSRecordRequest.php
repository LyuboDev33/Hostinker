<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DNSRecordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => ['required', 'in:A,AAAA,ANAME,CNAME,MX,NS,SRV,TXT'],
            'host' => ['required', 'string'],
            'answer' => ['required', 'string'],
            'ttl' => ['required', 'integer', 'min:300'],
            'priority' => ['nullable', 'required_if:type,MX,SRV', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'type.required' => 'Моля, изберете тип на DNS записа.',
            'type.in' => 'Избраният тип DNS запис е невалиден.',
            'host.required' => 'Моля, въведете име / host.',
            'answer.required' => 'Моля, въведете стойност / answer.',
            'ttl.required' => 'Моля, въведете TTL.',
            'ttl.integer' => 'TTL трябва да бъде цяло число.',
            'ttl.min' => 'Минималният TTL, позволен от Name.com, е 300 секунди.',
            'priority.required_if' => 'Приоритетът е задължителен за MX и SRV записи.',
            'priority.integer' => 'Приоритетът трябва да бъде цяло число.',
            'priority.min' => 'Приоритетът не може да бъде отрицателен.',
        ];
    }

    public function record(): array
    {
        $validated = $this->validated();

        $record = [
            'type' => $validated['type'],
            'host' => $validated['host'],
            'answer' => $validated['answer'],
            'ttl' => $validated['ttl'],
        ];

        if (in_array($validated['type'], ['MX', 'SRV'], true)) {
            $record['priority'] = $validated['priority'];
        }

        return $record;
    }

    
}
