MyServant
=========
Data about public servants of Formosans in the R.O.C. government.

Database Structure:
- party_list 政黨列表
- position_list 職稱列表

- province_list 省列表
- city_list 縣（市）列表
- district_list 鄉鎮市區列表
- village_list 村里列表

- legislator_list 立法委員列表
- legislator_type_list 立法委員類別列表
- legislator_committee_list 立法院委員會列表
- legislator_committee_pair 立法委員與委員會配對資料
- legislator_contact_spot 立法委員聯絡資訊
- legislator_election_district_list 立法委員選區列表

- local_representative_list 地方民意代表列表（含聯絡方式）
- local_representative_election_district_list 地方民意代表選區列表
 
- governor_list 行政機關首長列表（含聯絡方式）

Build Sequence:
因為有 foreign key 的關係，建置資料庫時請依下列順序建置：
- party_list
- position_list
- governor_list
- province_list
- legislator_election_district_list
- local_representative_election_district_list
- local_representative_list
- city_list
- district_list
- village_list
- legislator_committee_list
- legislator_type_list
- legislator_list
- legislator_committee_pair
- legislator_contact_spot
