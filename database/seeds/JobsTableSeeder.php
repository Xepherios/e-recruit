<?php

use Illuminate\Database\Seeder;
 
use Illuminate\Support\Facades\Hash;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = array(
            array(
                "name" => "PHP Developer",
                "description" => '<ul><li>ปรับปรุงและพัฒนาเวปไซต์ตามที่ได้รับมอบหมายและสามารถทำงานร่วมกับระบบต่างๆได้ดี</li>
                            <li>ติดต่อประสานงานกับทีมอื่นๆ เพื่อการแก้ไขปัญหาที่เกี่ยวข้อง</li>
                            <li>ปรับปรุง วิเคราะห์ และพัฒนาระบบให้สามารถใช้งานได้อย่างถูกต้องและมีประสิทธิภาพมากขึ้น</li>
                            </ul>',
                "qualification" => '<ul>
                <li>มีความรู้และสามารถใช้งาน PHP, Phalcon, Codeigniter, NodeJS, Express, React , Redux ได้เป็นอย่างดี</li>
                <li>มีความรู้และสามารถใช้งาน Git, Docker, MongoDB,SQL ได้</li>
                <li>มีความรู้และสามารถใช้งาน front-end framework ต่างๆได้</li>
                <li>มีมนุษยสัมพันธ์ที่ดีชอบการทำงานเป็นทีม</li>
                </ul>',
                "department" => 5,
                "min_salary" => 20000,
                "max_salary" => 50000 
            ),
            array(
                "name" => "Graphic Designer",
                "description" => '<ul>
                <li><span>ออกแบบและ สร้างสรรค์ งานด้านกราฟฟิคดีไซน์ สำหรับ Website และ Application MEB E-book, Readiwrite เช่น Banner, GAG สำหรับลง Facebook, ภาพสวยๆใน IG และ Twitter</span></li>
                <li><span>ทำงานร่วมกับ Marketing เพื่อสร้างสรรค์ Graphic Design ในการออก Campaign, Promotion และ Event ต่างๆ ทั้งด้าน Offline และ Online</span></li>
                <li><span>ใช้โปรแกรม Illustrator, Photoshop ได้เป็นอย่างดี</span></li>
                <li><span>ทำงานร่วมกับทีม Design ในโปรเจคต่างๆ</span></li>
                <li><span>คิด และสร้างสรรค์งานต่าง ๆ ในบริษัท เช่น สื่อสิ่งพิมพ์ และมัลติมีเดีย</span></li>
                <li><span>ออกแบบสื่อสิ่งพิมพ์ เช่น โบชัวร์, แผ่นพับ, Roll Up, Standee และสื่อสิ่งพิมพ์อื่นๆ</span></li>
                <li><span>จัดวาง Art work, Retouch</span></li>
                <li><span>มีความรับผิดชอบสูง ทำงานเร็วได้ทันตามกำหนดเวลา และทำงานเป็นทีมได้ดี&nbsp;</span>&nbsp;</li>
                </ul>',
                "qualification" => '<ul>
                <li><span>มีความเชี่ยวชาญในการตีโจทย์คอนเซ็ปของงานออกแบบ&nbsp;</span></li>
                <li><span>ถนัดงาน Retouch</span></li>
                <li><span>สามารถทำอักษรประดิษฐ์ได้</span></li>
                <li><span>ใช้โปรแกรม Photoshop และ Illustrator ได้เป็นอย่างดี</span></li>
                <li><span>มีความรู้ความสามารถในการคิดและสร้างสรรค์งานได้</span></li>
                <li><span>เพศชาย/หญิง อายุ 22- 35 ปี</span></li>
                <li><span>วุฒิการศึกษาปริญญาตรีขึ้นไป สาขานิเทศศิลป์ คอมพิวเตอร์กราฟฟิค Web Design หรือสาขาอื่นๆที่เกี่ยวข้อง</span></li>
                <li><span>มีประสบการณ์ทำงาน หากเคยออกแบบ font โปสเตอร์ภาพยนตร์ หรือ ปกหนังสือ จะได้รับการพิจารณาเป็นพิเศษ</span></li>
                <li><span>หากมีความชอบอ่านหนังสือ/นิยาย รู้จักแวดวงหนังสือดี จะได้รับพิจารณาเป็นพิเศษ</span></li>
                <li><span>กรุณาแนบ Portfolio เพื่อแสดงผลงานของท่าน</span>&nbsp;</li>
                </ul>',
                "department" => 2,
                "min_salary" => 20000,
                "max_salary" => 35000 
            ),
            array(
                "name" => "Sales Executive",
                "description" => '<ul>
                <li><span>รับผิดชอบงานขายโครงการแชทบอทสำหรับลูกค้าองค์กร</span></li>
                <li><span>ดูแลโครงการพัฒนาแชทบอทให้กับลูกค้าองค์กรต่างๆ</span></li>
                <li><span>ควบคุมดูแลความเรียบร้อย อำนวยความสะดวก และประสานงานเพื่อสนับสนุนการปฏิบัติหน้าที่และจัดกิจกรรมต่างๆภายใต้โครงการ</span></li>
                <li><span>บริหารคุณภาพงานแชทบอทของโครงการ</span></li>
                <li><span>ดูแลลูกค้าองค์กรที่ใช้แชทบอท รวมถึงการทำงานร่วมกับฝ่ายพัฒนาระบบเพื่อปรับปรุงหรือปรับแต่งแชทบอทตามความต้องการของลูกค้า</span></li>
                <li><span>เสนอความคิดสร้างสรรค์เพื่อการพัฒนาแชทบอทในอนาคต&nbsp;</span></li>
                </ul>',
                "qualification" => '<ul>
                <li><span>ประสบการณ์การขาย Product B2B อย่างน้อย 2 ปี</span></li>
                <li><span>ประสบการณ์การขาย Enterprise B2B Software is a plus</span></li>
                <li><span>มีความรู้และความเข้าใจในธุรกิจบริการลูกค้าในองค์กรขนาดใหญ่</span></li>
                </ul>',
                "department" => 3,
                "min_salary" => 20000,
                "max_salary" => 40000 
            ),
            array(
                "name" => "Senior Sales Executive",
                "description" => '<ul>
                <li><span>รับผิดชอบงานขายโครงการแชทบอทสำหรับลูกค้าองค์กร</span></li>
                <li><span>ดูแลโครงการพัฒนาแชทบอทให้กับลูกค้าองค์กรต่างๆ</span></li>
                <li><span>ควบคุมดูแลความเรียบร้อย อำนวยความสะดวก และประสานงานเพื่อสนับสนุนการปฏิบัติหน้าที่และจัดกิจกรรมต่างๆภายใต้โครงการ</span></li>
                <li><span>บริหารคุณภาพงานแชทบอทของโครงการ</span></li>
                <li><span>ดูแลลูกค้าองค์กรที่ใช้แชทบอท รวมถึงการทำงานร่วมกับฝ่ายพัฒนาระบบเพื่อปรับปรุงหรือปรับแต่งแชทบอทตามความต้องการของลูกค้า</span></li>
                <li><span>เสนอความคิดสร้างสรรค์เพื่อการพัฒนาแชทบอทในอนาคต&nbsp;</span></li>
                </ul>',
                "qualification" => '<ul>
                <li><span>ประสบการณ์การขาย Product B2B อย่างน้อย 5 ปี</span></li>
                <li><span>ประสบการณ์การขาย Enterprise B2B Software is a plus</span></li>
                <li><span>มีความรู้และความเข้าใจในธุรกิจบริการลูกค้าในองค์กรขนาดใหญ่</span></li>
                </ul>',
                "department" => 3,
                "min_salary" => 40000,
                "max_salary" => 60000 
            ),
            array(
                "name" => "Content Marketing Executive",
                "description" => '<ul>
                <li><span>วางแผน จัดทำกลยุทธ์ จากการวิเคราะห์ข้อมูลทางสถิติที่ได้จากสื่อออนไลน์และโซเชียลมีเดีย เพื่อประชาสัมพันธ์ และส่งเสริมด้านการตลาด</span></li>
                <li><span>เขียนและพัฒนาคอนเทนท์เกี่ยวกับสินค้าและบริการของบริษัท สื่อประชาสัมพันธ์ รวมถึงอัพเดทเกร็ดความรู้ด้าน Digital Marketing ผ่านแพลตฟอร์มต่างๆ</span></li>
                <li><span>ควบคุมและดูแลการสื่อสารทั้งหมดที่ออกจากองค์กรถึงลูกค้า ผ่านทางช่องทางออนไลน์ต่างๆ</span></li>
                 
                </ul>',
                "qualification" => '<ul>
                <li><span>ชาย/หญิง อายุไม่เกิน 35 ปี </span></li>
                <li><span>จบการศึกษาระดับปริญญาตรี/ปริญญาโท สาขาโฆษณาประชาสัมพันธ์, นวัตกรรมการสื่อสารการตลาด, Marketing Communication, นิเทศศาสตร์, เศรษฐศาสตร์ หรือสาขาอื่นที่เกี่ยวข้อง</span></li>
                <li><span>มีประสบการณ์ทำงาน 2-5 ปี สายงานการสื่อสารการตลาด ประชาสัมพันธ์ การสร้างแบรนด์สินค้าและบริการ</span></li>
                </ul>',
                "department" => 2,
                "min_salary" => 20000,
                "max_salary" => 40000 
            ),
        );
        for($i = 1; $i <= 5; $i++) { 
            DB::table('jobs')->insert([
                'job_name' => $data[$i-1]['name'],
                'job_description' => $data[$i-1]['description'],
                'job_qualification' => $data[$i-1]['qualification'],
                'department_id' => $data[$i-1]['department'],
                'min_salary' => $data[$i-1]['min_salary'],
                'max_salary' => $data[$i-1]['max_salary'],
            ]); 
        } 
    }
}
