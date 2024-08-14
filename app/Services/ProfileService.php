<?php

namespace App\Services;

use App\Repositories\ProfileRepositoryInterface;

class ProfileService implements ProfileRepositoryInterface
{
    public function __construct(protected ProfileRepositoryInterface $profileRepository)
    {
    }

    public function create($data)
    {
        $data["numero_di_telefono"] = $this->clearPrefix($data["numero_di_telefono"]);

        return $this->profileRepository->create($data);
    }

    private function clearPrefix($numero): string
    {
        $prefix = ["0093", "001", "00355", "00213", "00376", "00244", "001264", "001268", "00599", "00966", "0054", "00374", "00297", "00247", "0061", "0067210-1-2", "0043", "00994", "001242", "00973", "00880", "001246", "0032", "00501", "00229", "001441", "00975", "00375", "00591", "00387", "00267", "0055", "00673", "00359", "00226", "00257", "00855", "00237", "001", "00996", "00254", "00996", "00686", "00965", "00856", "00266", "00371", "00961", "00231", "00218", "00423", "00370", "00352", "00853", "00389", "00261", "00265", "00960", "0060", "00223", "00356", "00212", "00596", "00222", "00230", "0052", "00373", "00377", "00976", "001664", "00258", "00264", "00977", "00505", "00234", "00683", "0047", "00687", "00238", "00235", "0056", "0086", "00357", "0057", "00269", "00242", "00682", "00850", "0082", "00225", "00506", "00385", "0053", "0045", "00246", "001767", "00593", "0020", "00503", "00971", "00291", "00372", "00251", "007", "00679", "0063", "00358", "0033", "00241", "00220", "00995", "0049", "00233", "001876", "0081", "00350", "00253", "00962", "0044", "0030", "001473", "00299", "00590", "00671", "0064", "00968", "0031", "0092", "00680", "00507", "00675", "00595", "0051", "00689", "0048", "00351", "001787", "00974", "00420", "00236", "00243", "001", "00262", "0040", "00250", "00290", "001869", "00508", "001784", "00684", "00685", "001758", "00239", "00221", "00248", "00232", "0065", "00963", "00421", "00386", "00252", "0034", "0094", "0027", "00249", "0046", "0041", "00268", "00737", "00886", "00502", "00224", "00245", "00240", "00592", "00594", "00509", "00504", "00852", "0091", "0062", "0098", "00964", "00353", "00354", "001345", "00500", "00298", "00670", "00692", "00672", "00677", "001284", "001340", "00972", "00255", "0066", "00228", "00676", "001868", "00216", "0090", "00993", "001649", "00688", "00380", "00256", "0036", "00598", "001", "00998", "00678", "0058", "0084", "00681", "00967", "00381", "00260", "00263", "+93", "+1", "+355", "+213", "+376", "+244", "+1264", "+1268", "+599", "+966", "+54", "+374", "+297", "+247", "+61", "+67210-1-2", "+43", "+994", "+1242", "+973", "+880", "+1246", "+32", "+501", "+229", "+1441", "+975", "+375", "+591", "+387", "+267", "+55", "+673", "+359", "+226", "+257", "+855", "+237", "+1", "+996", "+254", "+996", "+686", "+965", "+856", "+266", "+371", "+961", "+231", "+218", "+423", "+370", "+352", "+853", "+389", "+261", "+265", "+960", "+60", "+223", "+356", "+212", "+596", "+222", "+230", "+52", "+373", "+377", "+976", "+1664", "+258", "+264", "+977", "+505", "+234", "+683", "+47", "+687", "+238", "+235", "+56", "+86", "+357", "+57", "+269", "+242", "+682", "+850", "+82", "+225", "+506", "+385", "+53", "+45", "+246", "+1767", "+593", "+20", "+503", "+971", "+291", "+372", "+251", "+7", "+679", "+63", "+358", "+33", "+241", "+220", "+995", "+49", "+233", "+1876", "+81", "+350", "+253", "+962", "+44", "+30", "+1473", "+299", "+590", "+671", "+64", "+968", "+31", "+92", "+680", "+507", "+675", "+595", "+51", "+689", "+48", "+351", "+1787", "+974", "+420", "+236", "+243", "+1", "+262", "+40", "+250", "+290", "+1869", "+508", "+1784", "+684", "+685", "+1758", "+239", "+221", "+248", "+232", "+65", "+963", "+421", "+386", "+252", "+34", "+94", "+27", "+249", "+46", "+41", "+268", "+737", "+886", "+502", "+224", "+245", "+240", "+592", "+594", "+509", "+504", "+852", "+91", "+62", "+98", "+964", "+353", "+354", "+1345", "+5", "+298", "+670", "+692", "+672", "+677", "+1284", "+1340", "+972", "+255", "+66", "+228", "+676", "+1868", "+216", "+90", "+993", "+1649", "+688", "+380", "+256", "+36", "+598", "+1", "+998", "+678", "+58", "+84", "+681", "+967", "+381", "+260", "+263",];

        foreach ($prefix as &$value) {
            if (str_starts_with($numero, $value)) {
                $numero = str_replace($value, "", $numero);
            }
        }

        return $numero;
    }

    public function update($data)
    {
        $data["numero_di_telefono"] = $this->clearPrefix($data["numero_di_telefono"]);

        return $this->profileRepository->update($data);
    }

    public function delete($id)
    {
        return $this->profileRepository->delete($id);
    }

    public function all()
    {
        return $this->profileRepository->all();
    }

    public function find($id)
    {
        return $this->profileRepository->find($id);
    }
}
